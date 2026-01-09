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
            return ['Year', 'Month', 'Total Orders', 'Total Revenue'];
        }

        return ['Day', 'Total Orders', 'Total Revenue'];
    }

    public function collection()
    {
        $query = DB::table('orders')
            ->where('status', 'delivered');

        if ($this->from) {
            $query->whereDate('created_at', '>=', $this->from);
        }
        if ($this->to) {
            $query->whereDate('created_at', '<=', $this->to);
        }

        if ($this->groupBy === 'month') {
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
