<?php

namespace App\Http\Controllers;

use App\Exports\ProductSalesExport;
use App\Exports\SalesSummaryExport;
use App\Models\Category;
use App\Models\Product;
use App\Models\SalesAdminProductStock;
use App\Models\SalesAdminStockTransfer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Notifications\StatusNotification;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ReportController extends Controller
{
    public function transferStockToSalesAdmin(Request $request)
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'sales_admin_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id')->where(function ($q) {
                    $q->where('role', 'sales_admin');
                }),
            ],
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $qty = (int) $validated['quantity'];

        $allocatedTotal = (int) SalesAdminProductStock::query()
            ->where('product_id', $product->id)
            ->sum('quantity');

        $adminStock = (int) $product->stock - $allocatedTotal;
        if ($qty > $adminStock) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Not enough Admin Stock. Available: ' . max(0, $adminStock));
        }

        DB::transaction(function () use ($validated, $product, $qty) {
            $stockRow = SalesAdminProductStock::query()->firstOrNew([
                'sales_admin_id' => $validated['sales_admin_id'],
                'product_id' => $product->id,
            ]);

            $stockRow->quantity = (int) ($stockRow->quantity ?? 0) + $qty;
            $stockRow->save();

            SalesAdminStockTransfer::create([
                'sales_admin_id' => $validated['sales_admin_id'],
                'product_id' => $product->id,
                'quantity' => $qty,
                'created_by' => auth()->id(),
            ]);
        });

        $salesAdmin = User::find($validated['sales_admin_id']);
        if ($salesAdmin) {
            $details = [
                'title' => 'Stock received: ' . $product->title . ' x' . $qty,
                'actionURL' => route('admin'),
                'fas' => 'fa-box',
            ];
            $salesAdmin->notify(new StatusNotification($details));

            $adminDetails = [
                'title' => 'Stock transferred to ' . $salesAdmin->name . ': ' . $product->title . ' x' . $qty,
                'actionURL' => route('admin'),
                'fas' => 'fa-box',
            ];
            auth()->user()->notify(new StatusNotification($adminDetails));
        }

        return redirect()->back()->with('success', 'Stock transferred successfully.');
    }

    public function productSales(Request $request)
    {
        $filters = $this->productSalesFilters($request);
        $rows = $this->productSalesRows($filters);

        $categories = Category::query()
            ->where('status', 'active')
            ->orderBy('title')
            ->get(['id', 'title']);

        return view('backend.reports.product-sales', [
            'rows' => $rows,
            'filters' => $filters,
            'categories' => $categories,
        ]);
    }

    public function productSalesPdf(Request $request)
    {
        $filters = $this->productSalesFilters($request);
        $rows = $this->productSalesRows($filters);

        $pdf = PDF::loadView('backend.reports.pdf.product-sales', [
            'rows' => $rows,
            'filters' => $filters,
        ]);

        return $pdf->download('product-sales-report.pdf');
    }

    public function productSalesExcel(Request $request)
    {
        $filters = $this->productSalesFilters($request);
        return Excel::download(new ProductSalesExport($filters), 'product-sales-report.xlsx');
    }

    public function salesAdminActivities(Request $request)
    {
        $validated = $request->validate([
            'date' => 'nullable|date',
            'sales_admin_id' => 'nullable|integer|exists:users,id',
        ]);

        $date = $validated['date'] ?? null;
        $salesAdminId = $validated['sales_admin_id'] ?? null;

        if ($salesAdminId) {
            $isSalesAdmin = User::query()
                ->where('id', $salesAdminId)
                ->where('role', 'sales_admin')
                ->exists();

            if (!$isSalesAdmin) {
                $salesAdminId = null;
            }
        }

        $salesAdmins = User::query()
            ->where('role', 'sales_admin')
            ->orderBy('name')
            ->get(['id', 'name', 'email', 'phone']);

        $products = Product::query()
            ->orderBy('title')
            ->get(['id', 'title']);

        // Orders summary (assigned orders + delivered revenue) and sold qty (from delivered carts)
        $ordersBaseAgg = DB::table('orders')
            ->select(
                'orders.sales_staff_id as sales_admin_id',
                DB::raw('COUNT(orders.id) as total_orders'),
                DB::raw("COALESCE(SUM(CASE WHEN orders.status = 'delivered' THEN orders.total_amount ELSE 0 END), 0) as total_revenue")
            )
            ->whereNotNull('orders.sales_staff_id')
            ->when($date, fn($q) => $q->whereDate('orders.created_at', '=', $date))
            ->when($salesAdminId, fn($q) => $q->where('orders.sales_staff_id', '=', $salesAdminId))
            ->groupBy('orders.sales_staff_id');

        $soldQtyAgg = DB::table('orders')
            ->join('carts', 'carts.order_id', '=', 'orders.id')
            ->select(
                'orders.sales_staff_id as sales_admin_id',
                DB::raw('COALESCE(SUM(carts.quantity), 0) as sold_qty')
            )
            ->whereNotNull('orders.sales_staff_id')
            ->where('orders.status', '=', 'delivered')
            ->when($date, fn($q) => $q->whereDate('orders.created_at', '=', $date))
            ->when($salesAdminId, fn($q) => $q->where('orders.sales_staff_id', '=', $salesAdminId))
            ->groupBy('orders.sales_staff_id');

        // Stock transfers summary (admin gave qty)
        $givenAgg = DB::table('sales_admin_stock_transfers')
            ->select(
                'sales_admin_id',
                DB::raw('COALESCE(SUM(quantity), 0) as given_qty')
            )
            ->when($date, fn($q) => $q->whereDate('created_at', '=', $date))
            ->when($salesAdminId, fn($q) => $q->where('sales_admin_id', '=', $salesAdminId))
            ->groupBy('sales_admin_id');

        $rows = DB::table('users')
            ->leftJoinSub($ordersBaseAgg, 'o', function ($join) {
                $join->on('users.id', '=', 'o.sales_admin_id');
            })
            ->leftJoinSub($soldQtyAgg, 's', function ($join) {
                $join->on('users.id', '=', 's.sales_admin_id');
            })
            ->leftJoinSub($givenAgg, 'g', function ($join) {
                $join->on('users.id', '=', 'g.sales_admin_id');
            })
            ->where('users.role', '=', 'sales_admin')
            ->when($salesAdminId, fn($q) => $q->where('users.id', '=', $salesAdminId))
            ->select(
                'users.id as sales_staff_id',
                'users.name as sales_admin_name',
                'users.email as sales_admin_email',
                'users.phone as sales_admin_phone',
                DB::raw('COALESCE(o.total_orders, 0) as total_orders'),
                DB::raw('COALESCE(g.given_qty, 0) as given_qty'),
                DB::raw('COALESCE(s.sold_qty, 0) as sold_qty'),
                DB::raw('COALESCE(o.total_revenue, 0) as total_revenue')
            )
            ->orderByDesc('total_revenue')
            ->get();

        $itemRows = collect();
        if ($salesAdminId) {
            $givenByProduct = DB::table('sales_admin_stock_transfers')
                ->where('sales_admin_id', '=', $salesAdminId)
                ->when($date, fn($q) => $q->whereDate('created_at', '=', $date))
                ->select(
                    'product_id',
                    DB::raw('COALESCE(SUM(quantity), 0) as given_qty')
                )
                ->groupBy('product_id');

            $soldByProduct = DB::table('orders')
                ->join('carts', 'carts.order_id', '=', 'orders.id')
                ->where('orders.sales_staff_id', '=', $salesAdminId)
                ->where('orders.status', '=', 'delivered')
                ->when($date, fn($q) => $q->whereDate('orders.created_at', '=', $date))
                ->select(
                    'carts.product_id',
                    DB::raw('COALESCE(SUM(carts.quantity), 0) as total_qty'),
                    DB::raw('MAX(DATE(orders.created_at)) as sold_date')
                )
                ->groupBy('carts.product_id');

            $purchasePriceExpr = 'COALESCE(products.purchase_price, products.wholesale_price, 0)';
            $salePriceExpr = 'COALESCE(products.sale_price, products.price, 0)';
            $totalQtyExpr = 'COALESCE(s.total_qty, 0)';
            $totalPriceExpr = '(' . $salePriceExpr . ' * ' . $totalQtyExpr . ')';
            $profitExpr = '((' . $salePriceExpr . ' - ' . $purchasePriceExpr . ') * ' . $totalQtyExpr . ')';

            $itemRows = DB::table('products')
                ->leftJoinSub($givenByProduct, 'g', function ($join) {
                    $join->on('products.id', '=', 'g.product_id');
                })
                ->leftJoinSub($soldByProduct, 's', function ($join) {
                    $join->on('products.id', '=', 's.product_id');
                })
                ->where(function ($q) {
                    $q->whereNotNull('g.given_qty')
                        ->orWhereNotNull('s.total_qty');
                })
                ->select(
                    'products.id as product_id',
                    'products.title as product',
                    DB::raw('COALESCE(s.sold_date, NULL) as sold_date'),
                    DB::raw($purchasePriceExpr . ' as purchase_price'),
                    DB::raw($salePriceExpr . ' as sale_price'),
                    DB::raw($totalQtyExpr . ' as total_qty'),
                    DB::raw($totalPriceExpr . ' as total_price'),
                    DB::raw($profitExpr . ' as profit')
                )
                ->orderByDesc('total_qty')
                ->get();
        }

        return view('backend.reports.sales-admin-activities', [
            'rows' => $rows,
            'itemRows' => $itemRows,
            'salesAdmins' => $salesAdmins,
            'products' => $products,
            'filters' => [
                'date' => $date,
                'sales_admin_id' => $salesAdminId,
            ],
        ]);
    }

    private function productSalesFilters(Request $request): array
    {
        $validated = $request->validate([
            'date' => 'nullable|date',
            'product' => 'nullable|string|max:255',
            'category_id' => 'nullable|integer|exists:categories,id',
            'status' => 'nullable|in:delivered,in_process',
        ]);

        return [
            'date' => $validated['date'] ?? null,
            'product' => $validated['product'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
            'status' => $validated['status'] ?? 'delivered',
        ];
    }

    public function salesSummary(Request $request)
    {
        $filters = $this->dateFilters($request);
        $groupBy = $request->get('group_by', 'day');
        if (!in_array($groupBy, ['day', 'month'], true)) {
            $groupBy = 'day';
        }

        $rows = $this->salesSummaryRows($filters['from'], $filters['to'], $groupBy);

        return view('backend.reports.sales-summary', [
            'rows' => $rows,
            'from' => $filters['from'],
            'to' => $filters['to'],
            'groupBy' => $groupBy,
        ]);
    }

    public function salesSummaryPdf(Request $request)
    {
        $filters = $this->dateFilters($request);
        $groupBy = $request->get('group_by', 'day');
        if (!in_array($groupBy, ['day', 'month'], true)) {
            $groupBy = 'day';
        }

        $rows = $this->salesSummaryRows($filters['from'], $filters['to'], $groupBy);

        $pdf = PDF::loadView('backend.reports.pdf.sales-summary', [
            'rows' => $rows,
            'from' => $filters['from'],
            'to' => $filters['to'],
            'groupBy' => $groupBy,
        ]);

        return $pdf->download('sales-summary-report.pdf');
    }

    public function salesSummaryExcel(Request $request)
    {
        $filters = $this->dateFilters($request);
        $groupBy = $request->get('group_by', 'day');
        if (!in_array($groupBy, ['day', 'month'], true)) {
            $groupBy = 'day';
        }

        return Excel::download(new SalesSummaryExport($filters['from'], $filters['to'], $groupBy), 'sales-summary-report.xlsx');
    }

    private function dateFilters(Request $request): array
    {
        $validated = $request->validate([
            'from' => 'nullable|date',
            'to' => 'nullable|date',
        ]);

        return [
            'from' => $validated['from'] ?? null,
            'to' => $validated['to'] ?? null,
        ];
    }

    private function productSalesRows(array $filters)
    {
        $date = $filters['date'] ?? null;
        $product = $filters['product'] ?? null;
        $categoryId = $filters['category_id'] ?? null;
        $statusFilter = $filters['status'] ?? 'delivered';

        // "In process" includes both process + ship.
        $statuses = $statusFilter === 'in_process' ? ['process', 'ship'] : ['delivered'];

        $purchasePriceExpr = 'COALESCE(products.purchase_price, products.wholesale_price, 0)';
        $salePriceExpr = 'COALESCE(products.sale_price, products.price, 0)';
        $totalQtyExpr = 'COALESCE(SUM(CASE WHEN orders.id IS NOT NULL THEN carts.quantity ELSE 0 END), 0)';
        $totalPriceExpr = '(' . $salePriceExpr . ' * ' . $totalQtyExpr . ')';

        $query = DB::table('products')
            ->leftJoin('carts', 'carts.product_id', '=', 'products.id')
            ->leftJoin('orders', function ($join) use ($date, $statuses) {
                $join->on('orders.id', '=', 'carts.order_id')
                    ->whereIn('orders.status', $statuses);

                if (auth()->check() && auth()->user()->role === 'sales_admin') {
                    $join->where('orders.sales_staff_id', '=', auth()->id());
                }

                if ($date) {
                    $join->whereDate('orders.created_at', '=', $date);
                }
            });

        if (!empty($product)) {
            $query->where('products.title', 'like', '%' . $product . '%');
        }
        if (!empty($categoryId)) {
            $query->where('products.cat_id', '=', $categoryId);
        }

        return $query
            ->select(
                'products.id as product_id',
                'products.title as product',
                DB::raw('MAX(DATE(orders.created_at)) as sold_date'),
                DB::raw($purchasePriceExpr . ' as purchase_price'),
                DB::raw($salePriceExpr . ' as sale_price'),
                DB::raw($totalQtyExpr . ' as total_qty'),
                DB::raw($totalPriceExpr . ' as total_price'),
                DB::raw('(' . $totalPriceExpr . ' - (' . $purchasePriceExpr . ' * ' . $totalQtyExpr . ')) as profit')
            )
                ->groupBy('products.id', 'products.title', 'products.purchase_price', 'products.wholesale_price', 'products.sale_price', 'products.price')
            ->orderByDesc('total_price')
            ->get();
    }

    private function salesSummaryRows(?string $from, ?string $to, string $groupBy)
    {
        $purchasePriceExpr = 'COALESCE(products.purchase_price, products.wholesale_price, 0)';
        $salePriceExpr = 'COALESCE(products.sale_price, products.price, 0)';

        $query = DB::table('orders')
            ->leftJoin('carts', 'carts.order_id', '=', 'orders.id')
            ->leftJoin('products', 'products.id', '=', 'carts.product_id')
            ->where('orders.status', 'delivered');

        if (auth()->check() && auth()->user()->role === 'sales_admin') {
            $query->where('sales_staff_id', auth()->id());
        }

        if ($from) {
            $query->whereDate('orders.created_at', '>=', $from);
        }
        if ($to) {
            $query->whereDate('orders.created_at', '<=', $to);
        }

        if ($groupBy === 'month') {
            return $query
                ->select(
                    DB::raw('YEAR(orders.created_at) as year'),
                    DB::raw('MONTH(orders.created_at) as month'),
                    DB::raw('COUNT(DISTINCT orders.id) as total_orders'),
                    DB::raw('COALESCE(SUM(carts.quantity), 0) as total_qty'),
                    DB::raw('COALESCE(SUM((' . $purchasePriceExpr . ') * carts.quantity), 0) as purchase_total'),
                    DB::raw('COALESCE(SUM((' . $salePriceExpr . ') * carts.quantity), 0) as total_price'),
                    DB::raw('COALESCE(SUM(((' . $salePriceExpr . ') - (' . $purchasePriceExpr . ')) * carts.quantity), 0) as profit')
                )
                ->groupBy(DB::raw('YEAR(orders.created_at)'), DB::raw('MONTH(orders.created_at)'))
                ->orderBy(DB::raw('YEAR(orders.created_at)'), 'desc')
                ->orderBy(DB::raw('MONTH(orders.created_at)'), 'desc')
                ->get();
        }

        // day
        return $query
            ->select(
                DB::raw('DATE(orders.created_at) as day'),
                DB::raw('COUNT(DISTINCT orders.id) as total_orders'),
                DB::raw('COALESCE(SUM(carts.quantity), 0) as total_qty'),
                DB::raw('COALESCE(SUM((' . $purchasePriceExpr . ') * carts.quantity), 0) as purchase_total'),
                DB::raw('COALESCE(SUM((' . $salePriceExpr . ') * carts.quantity), 0) as total_price'),
                DB::raw('COALESCE(SUM(((' . $salePriceExpr . ') - (' . $purchasePriceExpr . ')) * carts.quantity), 0) as profit')
            )
            ->groupBy(DB::raw('DATE(orders.created_at)'))
            ->orderBy(DB::raw('DATE(orders.created_at)'), 'desc')
            ->get();
    }
}
