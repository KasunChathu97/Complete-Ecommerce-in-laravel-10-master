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
        @php
            $filters = $filters ?? [];
        @endphp
        <div>
            <strong>Date:</strong> {{ $filters['date'] ?? '-' }}
            @if(!empty($filters['product']))
                &nbsp;&nbsp; <strong>Product:</strong> {{ $filters['product'] }}
            @endif
            @if(!empty($filters['category_id']))
                &nbsp;&nbsp; <strong>Category ID:</strong> {{ $filters['category_id'] }}
            @endif
            @if(!empty($filters['status']))
                &nbsp;&nbsp; <strong>Status:</strong>
                {{ $filters['status'] === 'in_process' ? 'In Process' : 'Delivered' }}
            @endif
        </div>
        <div>
            <strong>
                {{ ($filters['status'] ?? 'delivered') === 'in_process' ? 'Only In Process Orders' : 'Only Delivered Orders' }}
            </strong>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Sold Date</th>
                <th class="right">Purchase Price</th>
                <th class="right">Sales Price</th>
                <th class="right">Total Qty</th>
                <th class="right">Total Price</th>
                <th class="right">Profit</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rows as $row)
                <tr>
                    <td>{{ $row->product }}</td>
                    <td>{{ $row->sold_date ?? '-' }}</td>
                    <td class="right">
                        @if($row->purchase_price === null)
                            -
                        @else
                            ${{ number_format((float) $row->purchase_price, 2) }}
                        @endif
                    </td>
                    <td class="right">${{ number_format((float) $row->sale_price, 2) }}</td>
                    <td class="right">{{ (int) $row->total_qty }}</td>
                    <td class="right">${{ number_format((float) $row->total_price, 2) }}</td>
                    <td class="right">
                        @if($row->profit === null)
                            -
                        @else
                            ${{ number_format((float) $row->profit, 2) }}
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No data found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
