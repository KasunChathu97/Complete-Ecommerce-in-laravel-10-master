<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SalesSummaryExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function __construct(private ?string $from, private ?string $to, private string $groupBy)
    {
    }

    public function headings(): array
    {
        if ($this->groupBy === 'month') {
            return ['Year', 'Month', 'Total Orders', 'Total Qty', 'Purchase Total', 'Total Price', 'Profit'];
        }

        return ['Day', 'Total Orders', 'Total Qty', 'Purchase Total', 'Total Price', 'Profit'];
    }

    public function collection()
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

        if ($this->from) {
            $query->whereDate('orders.created_at', '>=', $this->from);
        }
        if ($this->to) {
            $query->whereDate('orders.created_at', '<=', $this->to);
        }

        if ($this->groupBy === 'month') {
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
