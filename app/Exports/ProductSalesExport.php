<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductSalesExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function __construct(private array $filters = [])
    {
    }

    public function headings(): array
    {
        return ['Product ID', 'Product', 'Sold Date', 'Purchase Price', 'Sales Price', 'Total Qty', 'Total Price', 'Profit'];
    }

    public function collection()
    {
        $date = $this->filters['date'] ?? null;
        $product = $this->filters['product'] ?? null;
        $categoryId = $this->filters['category_id'] ?? null;
        $statusFilter = $this->filters['status'] ?? 'delivered';

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
}
