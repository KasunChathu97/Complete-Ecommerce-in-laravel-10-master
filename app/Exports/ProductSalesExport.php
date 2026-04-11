<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProductSalesExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function __construct(private ?string $from, private ?string $to)
    {
    }

    public function headings(): array
    {
        return ['Product ID', 'Product', 'Purchase Price', 'Sales Price', 'Total Qty', 'Total Price', 'Profit'];
    }

    public function collection()
    {
        $purchasePriceExpr = 'COALESCE(products.purchase_price, products.wholesale_price, 0)';
        $salePriceExpr = 'COALESCE(products.sale_price, products.price, 0)';
        $totalQtyExpr = 'COALESCE(SUM(CASE WHEN orders.id IS NOT NULL THEN carts.quantity ELSE 0 END), 0)';
        $totalPriceExpr = '(' . $salePriceExpr . ' * ' . $totalQtyExpr . ')';

        $query = DB::table('products')
            ->leftJoin('carts', 'carts.product_id', '=', 'products.id')
            ->leftJoin('orders', function ($join) {
                $join->on('orders.id', '=', 'carts.order_id')
                    ->where('orders.status', '=', 'delivered');

                if (auth()->check() && auth()->user()->role === 'sales_admin') {
                    $join->where('orders.sales_staff_id', '=', auth()->id());
                }

                if ($this->from) {
                    $join->whereDate('orders.created_at', '>=', $this->from);
                }
                if ($this->to) {
                    $join->whereDate('orders.created_at', '<=', $this->to);
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
}
