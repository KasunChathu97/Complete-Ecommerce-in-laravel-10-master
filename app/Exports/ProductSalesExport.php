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
        return ['Product ID', 'Product', 'Total Qty', 'Total Revenue'];
    }

    public function collection()
    {
        $query = DB::table('carts')
            ->join('orders', 'carts.order_id', '=', 'orders.id')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->whereNotNull('carts.order_id')
            ->where('orders.status', 'delivered');

        if ($this->from) {
            $query->whereDate('orders.created_at', '>=', $this->from);
        }
        if ($this->to) {
            $query->whereDate('orders.created_at', '<=', $this->to);
        }

        return $query
            ->select(
                'products.id as product_id',
                'products.title as product',
                DB::raw('SUM(carts.quantity) as total_qty'),
                DB::raw('SUM(carts.amount) as total_revenue')
            )
            ->groupBy('products.id', 'products.title')
            ->orderByDesc('total_revenue')
            ->get();
    }
}
