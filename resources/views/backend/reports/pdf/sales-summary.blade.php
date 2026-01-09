<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sales Summary Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { margin: 0 0 10px 0; }
        .meta { margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 6px; }
        th { background: #f3f3f3; }
        .right { text-align: right; }
    </style>
</head>
<body>
    <h2>Sales Summary Report</h2>
    <div class="meta">
        <div><strong>Group By:</strong> {{ $groupBy === 'month' ? 'Monthly' : 'Daily' }}</div>
        <div><strong>From:</strong> {{ $from ?? '-' }} &nbsp;&nbsp; <strong>To:</strong> {{ $to ?? '-' }}</div>
        <div><strong>Only Delivered Orders</strong></div>
    </div>

    <table>
        <thead>
            @if($groupBy === 'month')
                <tr>
                    <th>Year</th>
                    <th>Month</th>
                    <th class="right">Total Orders</th>
                    <th class="right">Total Revenue</th>
                </tr>
            @else
                <tr>
                    <th>Day</th>
                    <th class="right">Total Orders</th>
                    <th class="right">Total Revenue</th>
                </tr>
            @endif
        </thead>
        <tbody>
            @forelse($rows as $row)
                @if($groupBy === 'month')
                    <tr>
                        <td>{{ $row->year }}</td>
                        <td>{{ $row->month }}</td>
                        <td class="right">{{ (int) $row->total_orders }}</td>
                        <td class="right">${{ number_format((float) $row->total_revenue, 2) }}</td>
                    </tr>
                @else
                    <tr>
                        <td>{{ $row->day }}</td>
                        <td class="right">{{ (int) $row->total_orders }}</td>
                        <td class="right">${{ number_format((float) $row->total_revenue, 2) }}</td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="4">No data found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
