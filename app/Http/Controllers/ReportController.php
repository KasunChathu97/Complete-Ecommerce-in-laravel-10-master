<?php

namespace App\Http\Controllers;

use App\Exports\ProductSalesExport;
use App\Exports\SalesSummaryExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ReportController extends Controller
{
    public function productSales(Request $request)
    {
        $filters = $this->dateFilters($request);
        $rows = $this->productSalesRows($filters['from'], $filters['to']);

        return view('backend.reports.product-sales', [
            'rows' => $rows,
            'from' => $filters['from'],
            'to' => $filters['to'],
        ]);
    }

    public function productSalesPdf(Request $request)
    {
        $filters = $this->dateFilters($request);
        $rows = $this->productSalesRows($filters['from'], $filters['to']);

        $pdf = PDF::loadView('backend.reports.pdf.product-sales', [
            'rows' => $rows,
            'from' => $filters['from'],
            'to' => $filters['to'],
        ]);

        return $pdf->download('product-sales-report.pdf');
    }

    public function productSalesExcel(Request $request)
    {
        $filters = $this->dateFilters($request);
        return Excel::download(new ProductSalesExport($filters['from'], $filters['to']), 'product-sales-report.xlsx');
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

    private function productSalesRows(?string $from, ?string $to)
    {
        $purchasePriceExpr = 'COALESCE(products.purchase_price, products.wholesale_price, 0)';
        $salePriceExpr = 'COALESCE(products.sale_price, products.price, 0)';
        $totalQtyExpr = 'COALESCE(SUM(CASE WHEN orders.id IS NOT NULL THEN carts.quantity ELSE 0 END), 0)';
        $totalPriceExpr = '(' . $salePriceExpr . ' * ' . $totalQtyExpr . ')';

        $query = DB::table('products')
            ->leftJoin('carts', 'carts.product_id', '=', 'products.id')
            ->leftJoin('orders', function ($join) use ($from, $to) {
                $join->on('orders.id', '=', 'carts.order_id')
                    ->where('orders.status', '=', 'delivered');

                if (auth()->check() && auth()->user()->role === 'sales_admin') {
                    $join->where('orders.sales_staff_id', '=', auth()->id());
                }

                if ($from) {
                    $join->whereDate('orders.created_at', '>=', $from);
                }
                if ($to) {
                    $join->whereDate('orders.created_at', '<=', $to);
                }
            });

        return $query
            ->select(
                'products.id as product_id',
                'products.title as product',
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
        $query = DB::table('orders')
            ->where('status', 'delivered');

        if (auth()->check() && auth()->user()->role === 'sales_admin') {
            $query->where('sales_staff_id', auth()->id());
        }

        if ($from) {
            $query->whereDate('created_at', '>=', $from);
        }
        if ($to) {
            $query->whereDate('created_at', '<=', $to);
        }

        if ($groupBy === 'month') {
            return $query
                ->select(
                    DB::raw('YEAR(created_at) as year'),
                    DB::raw('MONTH(created_at) as month'),
                    DB::raw('COUNT(*) as total_orders'),
                    DB::raw('SUM(total_amount) as total_revenue')
                )
                ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
                ->orderBy(DB::raw('YEAR(created_at)'), 'desc')
                ->orderBy(DB::raw('MONTH(created_at)'), 'desc')
                ->get();
        }

        // day
        return $query
            ->select(
                DB::raw('DATE(created_at) as day'),
                DB::raw('COUNT(*) as total_orders'),
                DB::raw('SUM(total_amount) as total_revenue')
            )
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy(DB::raw('DATE(created_at)'), 'desc')
            ->get();
    }
}
