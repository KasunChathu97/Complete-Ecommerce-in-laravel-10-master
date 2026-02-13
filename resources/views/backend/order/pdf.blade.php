<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Invoice @if($order)- {{$order->order_number}} @endif</title>
  {{-- Keep PDF rendering self-contained (no remote CSS/assets). --}}
</head>
<body>

@if($order)
@php
  // Avoid HTTP requests during PDF rendering (Dompdf can hang on remote fetches)
  $logoPath = public_path('backend/img/logo2.png');
  $logoDataUri = null;
  if (is_file($logoPath)) {
    $logoDataUri = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
  }

  // Company contact details (prefer DB settings; fall back to .env)
  $settingRow = null;
  try {
    $settingRow = \App\Models\Settings::query()->first();
  } catch (\Throwable $e) {
    $settingRow = null;
  }

  $companyName = (string) (env('APP_NAME') ?? '');
  $companyAddress = (string) (($settingRow->address ?? '') ?: (env('APP_ADDRESS') ?? ''));
  $companyPhone = (string) (($settingRow->phone ?? '') ?: (env('APP_PHONE') ?? ''));
  $companyEmail = (string) (($settingRow->email ?? '') ?: (env('APP_EMAIL') ?? ''));

  $subTotal = (float) ($order->sub_total ?? 0);
  $discount = (float) ($order->coupon ?? 0);
  $deliveryCharge = (float) ($order->delivery_charge ?? 0);
  $grandTotal = (float) ($order->total_amount ?? 0);

  // The app does not store the chosen shipping method fee on the order; derive it from totals.
  $derivedShippingFee = $grandTotal - $subTotal - $deliveryCharge + $discount;
  $shippingFee = max(0, (float) $derivedShippingFee);
  $shippingTotal = $deliveryCharge + $shippingFee;
  $showShippingBreakdown = abs($shippingFee - $deliveryCharge) > 0.01 && $shippingFee > 0.01;

  $invoiceDate = optional($order->created_at)->format('d M Y') ?? '';
@endphp

<style type="text/css">
  @page { margin: 24px; }
  body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 12px; color: #111827; }
  .muted { color: #6b7280; }
  .h1 { font-size: 18px; font-weight: 700; margin: 0; }
  .h2 { font-size: 13px; font-weight: 700; margin: 0 0 6px 0; }
  .box { border: 1px solid #e5e7eb; border-radius: 6px; padding: 12px; }
  .mt-12 { margin-top: 12px; }
  .mb-6 { margin-bottom: 6px; }
  .w-100 { width: 100%; }
  .text-right { text-align: right; }
  .text-center { text-align: center; }
  .nowrap { white-space: nowrap; }
  .divider { height: 1px; background: #e5e7eb; margin: 12px 0; }

  table { border-collapse: collapse; }
  .items th { background: #f3f4f6; border: 1px solid #e5e7eb; padding: 8px; font-weight: 700; }
  .items td { border: 1px solid #e5e7eb; padding: 8px; vertical-align: top; }
  .totals td { padding: 4px 0; }
</style>

<table class="w-100">
  <tr>
    <td style="width: 55%; vertical-align: top;">
      @if($logoDataUri)
        <img src="{{$logoDataUri}}" alt="" style="max-width: 140px; height: auto;">
      @endif
      <div class="h1" style="margin-top: 6px;">{{ $companyName }}</div>
      @if($companyAddress !== '')
        <div class="muted" style="margin-top: 4px;">{{ $companyAddress }}</div>
      @endif
      @if($companyPhone !== '')
        <div class="muted" style="margin-top: 2px;">Phone: {{ $companyPhone }}</div>
      @endif
      @if($companyEmail !== '')
        <div class="muted" style="margin-top: 2px;">Email: {{ $companyEmail }}</div>
      @endif
    </td>
    <td style="width: 45%; vertical-align: top;" class="text-right">
      <div class="h1">INVOICE</div>
      <div class="muted" style="margin-top: 6px;">Invoice #: <strong>{{ $order->order_number }}</strong></div>
      @if($invoiceDate !== '')
        <div class="muted" style="margin-top: 2px;">Date: <strong>{{ $invoiceDate }}</strong></div>
      @endif
      <div class="muted" style="margin-top: 2px;">Order Status: <strong>{{ strtoupper((string) $order->status) }}</strong></div>
      <div class="muted" style="margin-top: 2px;">Payment: <strong>{{ strtoupper((string) $order->payment_method) }}</strong> ({{ strtoupper((string) $order->payment_status) }})</div>
      @if(!empty($order->payment_reference))
        <div class="muted" style="margin-top: 2px;">Reference: <strong>{{ $order->payment_reference }}</strong></div>
      @endif
    </td>
  </tr>
</table>

<div class="divider"></div>

<table class="w-100">
  <tr>
    <td style="width: 50%; vertical-align: top; padding-right: 8px;">
      <div class="box">
        <div class="h2">Bill To</div>
        <div><strong>{{ $order->first_name }} {{ $order->last_name }}</strong></div>
        <div class="muted">{{ $order->email }}</div>
        <div class="muted">{{ $order->phone }}</div>
        <div style="margin-top: 6px;">{{ $order->address1 }}</div>
        @if(!empty($order->address2))
          <div>{{ $order->address2 }}</div>
        @endif
        <div class="muted" style="margin-top: 4px;">{{ $order->country }} @if(!empty($order->post_code)) - {{ $order->post_code }} @endif</div>
      </div>
    </td>
    <td style="width: 50%; vertical-align: top; padding-left: 8px;">
      <div class="box">
        <div class="h2">Shipping</div>
        <div class="muted">Method: <strong>{{ optional($order->shipping)->type ?? 'N/A' }}</strong></div>
        <div class="muted">Shipping Total: <strong>{{ Helper::formatCurrency($shippingTotal) }}</strong></div>
        @if($showShippingBreakdown)
          <div class="muted" style="margin-top: 2px;">Delivery Charge: <strong>{{ Helper::formatCurrency($deliveryCharge) }}</strong></div>
          <div class="muted" style="margin-top: 2px;">Shipping Fee: <strong>{{ Helper::formatCurrency($shippingFee) }}</strong></div>
        @endif
        @if(!empty($order->courier_name) || !empty($order->tracking_number))
          <div style="margin-top: 6px;">
            @if(!empty($order->courier_name))
              <div class="muted">Courier: <strong>{{ $order->courier_name }}</strong></div>
            @endif
            @if(!empty($order->tracking_number))
              <div class="muted">Tracking #: <strong>{{ $order->tracking_number }}</strong></div>
            @endif
          </div>
        @endif
      </div>
    </td>
  </tr>
</table>

<div class="mt-12"></div>

<table class="w-100 items">
  <thead>
    <tr>
      <th style="width: 45%;">Item</th>
      <th style="width: 15%;" class="text-center">Qty</th>
      <th style="width: 20%;" class="text-right">Unit Price</th>
      <th style="width: 20%;" class="text-right">Line Total</th>
    </tr>
  </thead>
  <tbody>
    @foreach($order->cart_info as $cart)
      @php
        $unitPrice = (float) ($cart->price ?? 0);
        $qty = (int) ($cart->quantity ?? 0);
        $lineTotal = (float) ($cart->amount ?? ($unitPrice * $qty));
      @endphp
      <tr>
        <td>
          <div><strong>{{ optional($cart->product)->title ?? 'Item' }}</strong></div>
        </td>
        <td class="text-center nowrap">{{ $qty }}</td>
        <td class="text-right nowrap">{{ Helper::formatCurrency($unitPrice) }}</td>
        <td class="text-right nowrap">{{ Helper::formatCurrency($lineTotal) }}</td>
      </tr>
    @endforeach
  </tbody>
</table>

<table class="w-100 mt-12">
  <tr>
    <td style="width: 55%; vertical-align: top;">
      @if(!empty($order->notes))
        <div class="box">
          <div class="h2">Notes</div>
          <div class="muted">{{ $order->notes }}</div>
        </div>
      @endif
    </td>
    <td style="width: 45%; vertical-align: top;">
      <div class="box">
        <table class="w-100 totals">
          <tr>
            <td class="muted">Subtotal</td>
            <td class="text-right nowrap"><strong>{{ Helper::formatCurrency($subTotal) }}</strong></td>
          </tr>
          @if($discount > 0)
            <tr>
              <td class="muted">Discount</td>
              <td class="text-right nowrap"><strong>-{{ Helper::formatCurrency($discount) }}</strong></td>
            </tr>
          @endif
          <tr>
            <td class="muted">Shipping</td>
            <td class="text-right nowrap"><strong>{{ Helper::formatCurrency($shippingTotal) }}</strong></td>
          </tr>
          @if($showShippingBreakdown)
            <tr>
              <td class="muted">&nbsp;&nbsp;Delivery Charge</td>
              <td class="text-right nowrap"><strong>{{ Helper::formatCurrency($deliveryCharge) }}</strong></td>
            </tr>
            <tr>
              <td class="muted">&nbsp;&nbsp;Shipping Fee</td>
              <td class="text-right nowrap"><strong>{{ Helper::formatCurrency($shippingFee) }}</strong></td>
            </tr>
          @endif
          <tr>
            <td colspan="2"><div class="divider" style="margin: 8px 0;"></div></td>
          </tr>
          <tr>
            <td style="font-size: 13px; font-weight: 700;">Grand Total</td>
            <td class="text-right nowrap" style="font-size: 13px; font-weight: 700;">{{ Helper::formatCurrency($grandTotal) }}</td>
          </tr>
        </table>
      </div>
    </td>
  </tr>
</table>

<div class="mt-12"></div>
<div class="text-center muted">Thank you for your purchase.</div>
@else
  <h5>Invalid</h5>
@endif
</body>
</html>