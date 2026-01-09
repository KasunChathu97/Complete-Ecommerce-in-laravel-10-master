<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Product-wise Sales Report</title>
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
    <h2>Product-wise Sales Report</h2>
    <div class="meta">
        <div><strong>From:</strong> {{ $from ?? '-' }} &nbsp;&nbsp; <strong>To:</strong> {{ $to ?? '-' }}</div>
        <div><strong>Only Delivered Orders</strong></div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th class="right">Total Qty</th>
                <th class="right">Total Revenue</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rows as $row)
                <tr>
                    <td>{{ $row->product }}</td>
                    <td class="right">{{ (int) $row->total_qty }}</td>
                    <td class="right">${{ number_format((float) $row->total_revenue, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No data found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
