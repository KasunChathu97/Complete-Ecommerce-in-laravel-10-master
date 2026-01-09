<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMS Log Notification</title>
</head>
<body style="margin:0;padding:0;background:#f7fafc;font-family: Arial, Helvetica, sans-serif; line-height:1.5;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#f7fafc;padding:24px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="width:600px;max-width:600px;background:#ffffff;border:1px solid #e2e8f0;border-radius:10px;overflow:hidden;">
                    <tr>
                        <td align="center" style="padding:18px 20px;background:#ffffff;">
                            <div style="color:#718096;font-size:13px;">{{ $appName ?? config('app.name') }}</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:20px 22px;">
                            <h2 style="margin:0 0 12px;font-size:20px;color:#2d3748;">SMS Log Notification</h2>

    @php
        $order = $smsLog->order;
    @endphp

    @if($order)
        <p style="margin:0 0 10px;color:#4a5568;"><strong style="color:#2d3748;">Order:</strong> {{ $order->order_number ?? ('#'.$order->id) }}</p>
        <p style="margin:0 0 10px;color:#4a5568;"><strong style="color:#2d3748;">Status:</strong> {{ $order->status ?? 'N/A' }}</p>
    @endif

    <p style="margin:0 0 10px;color:#4a5568;"><strong style="color:#2d3748;">Phone:</strong> {{ $smsLog->phone }}</p>
    <p style="margin:0 0 10px;color:#4a5568;"><strong style="color:#2d3748;">Message:</strong></p>
    <div style="padding:12px 14px;background:#f7fafc;border:1px solid #e2e8f0;border-radius:8px;color:#2d3748;white-space:pre-wrap;">{{ $smsLog->message }}</div>

                            <p style="margin:14px 0 0;color:#718096;font-size:12px;">
                                Generated at {{ now() }}
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
