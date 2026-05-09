@extends('backend.layouts.master')

@section('title','Order Detail')

@section('main-content')
<div class="card">
  <h5 class="card-header">Order Edit</h5>
  <div class="card-body">
    <form action="{{route('order.update',$order->id)}}" method="POST">
      @csrf
      @method('PATCH')

      @if(auth()->check() && auth()->user()->role === 'admin')
      <div class="form-group">
        <label for="sales_staff_id">Assign Sales Admin :</label>
        <select name="sales_staff_id" class="form-control">
          <option value="">-- Unassigned --</option>
          @foreach(($salesAdmins ?? []) as $sa)
            <option value="{{ $sa->id }}" {{ (string)old('sales_staff_id', $order->sales_staff_id) === (string)$sa->id ? 'selected' : '' }}>
              {{ $sa->name }} ({{ $sa->email }})
            </option>
          @endforeach
        </select>
      </div>
      @endif

      @php
        $orderedItemNames = $order->cart
          ->map(function ($cart) {
            return optional($cart->product)->title;
          })
          ->filter();
        $orderedItemsText = $orderedItemNames->isNotEmpty() ? $orderedItemNames->implode(', ') : '-';
      @endphp

      <div class="form-group">
        <label>Order Items :</label>
        <input type="text" class="form-control" value="{{ $orderedItemsText }}" readonly>
      </div>

      <div class="form-group">
        <label>Order Number :</label>
        <input type="text" class="form-control" value="{{ $order->order_number }}" readonly>
      </div>

      <div class="form-group">
        <label for="courier_name">Courier Name :</label>
        <input type="text" name="courier_name" class="form-control" value="{{ old('courier_name', $order->courier_name) }}" placeholder="e.g. DHL / FedEx / Local Courier">
      </div>

      <div id="courier-tracking-fields">
        <div class="form-group">
          <label for="courier_tracking_number">Courier Tracking Number :</label>
          <input
            type="text"
            name="courier_tracking_number"
            class="form-control"
            value="{{ old('courier_tracking_number', $order->status === 'delivered' ? $order->courier_tracking_number : '') }}"
            placeholder="Enter courier tracking number">
        </div>
      </div>

      <div class="form-group">
        <label for="status">Status :</label>
        @php
          $currentStatus = old('status', $order->status);
          if ($currentStatus === 'pending') {
            $currentStatus = 'ship';
          }
        @endphp
        <select name="status" id="order_status" class="form-control">
          <option value="new" {{($order->status!='new') ? 'disabled' : ''}}  {{(($currentStatus=='new')? 'selected' : '')}}>New</option>
          <option value="process" {{($order->status=='delivered'|| $order->status=="cancel") ? 'disabled' : ''}}  {{(($currentStatus=='process')? 'selected' : '')}}>process</option>
          <option value="ship" {{($order->status=="delivered"|| $order->status=="cancel") ? 'disabled' : ''}}  {{(($currentStatus=='ship')? 'selected' : '')}}>ship</option>
          <option value="delivered" {{($order->status=="cancel") ? 'disabled' : ''}}  {{(($currentStatus=='delivered')? 'selected' : '')}}>Delivered</option>
          <option value="returned" {{($order->status!="delivered" && $order->status!="returned") ? 'disabled' : ''}}  {{(($currentStatus=='returned')? 'selected' : '')}}>Returned</option>
          <option value="cancel" {{($order->status=='delivered' || $order->status=='returned') ? 'disabled' : ''}}  {{(($currentStatus=='cancel')? 'selected' : '')}}>Cancel</option>
        </select>
      </div>

      <div id="return-reason-fields">
        <div class="form-group">
          @php
            $returnReasonOptions = [
              'Damaged product',
              'Wrong item delivered',
              'Size/Color issue',
              'Customer changed mind',
              'Late delivery',
            ];
            $existingReason = (string) old('return_reason_custom', $order->return_reason);
            $existingOption = (string) old('return_reason_option', in_array($existingReason, $returnReasonOptions, true) ? $existingReason : 'other');
          @endphp

          <label for="return_reason_option">Return reason :</label>
          <select name="return_reason_option" id="return_reason_option" class="form-control">
            <option value="" {{ $existingOption === '' ? 'selected' : '' }}>-- Select reason --</option>
            @foreach($returnReasonOptions as $opt)
              <option value="{{ $opt }}" {{ $existingOption === $opt ? 'selected' : '' }}>{{ $opt }}</option>
            @endforeach
            <option value="other" {{ $existingOption === 'other' ? 'selected' : '' }}>Other</option>
          </select>
          @error('return_reason_option')
            <span class="text-danger">{{ $message }}</span>
          @enderror

          <div id="return-reason-custom" style="margin-top:10px;">
            <label for="return_reason_custom" class="mb-1">Custom reason :</label>
            <textarea name="return_reason_custom" id="return_reason_custom" class="form-control" rows="3" placeholder="Enter custom reason...">{{ old('return_reason_custom', in_array($existingReason, $returnReasonOptions, true) ? '' : $existingReason) }}</textarea>
            @error('return_reason_custom')
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>

          <small class="form-text text-muted">Required when marking an order as returned. Choose a reason or select Other.</small>
        </div>
      </div>

      @if(auth()->check() && auth()->user()->role === 'admin')
      <div class="form-group">
        <label for="payment_status">Payment Status :</label>
        <select name="payment_status" class="form-control">
          <option value="unpaid" {{ old('payment_status', $order->payment_status) === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
          <option value="paid" {{ old('payment_status', $order->payment_status) === 'paid' ? 'selected' : '' }}>Paid</option>
        </select>
        <small class="form-text text-muted">Use this when COD/manual payments are received.</small>
      </div>
      @endif
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>
@endsection

@push('styles')
<style>
    .order-info,.shipping-info{
        background:#ECECEC;
        padding:20px;
    }
    .order-info h4,.shipping-info h4{
        text-decoration: underline;
    }

</style>
@endpush

@push('scripts')
<script>
  (function () {
    var statusSelect = document.getElementById('order_status');
    var container = document.getElementById('courier-tracking-fields');
    var returnContainer = document.getElementById('return-reason-fields');
    var reasonSelect = document.getElementById('return_reason_option');
    var reasonCustom = document.getElementById('return-reason-custom');
    if (!statusSelect || !container) {
      return;
    }

    function toggleCourierFields() {
      var isDelivered = (statusSelect.value === 'delivered');
      container.style.display = isDelivered ? '' : 'none';

      var inputs = container.querySelectorAll('input, textarea, select');
      for (var i = 0; i < inputs.length; i++) {
        inputs[i].disabled = !isDelivered;
      }
    }

    function toggleReturnFields() {
      if (!returnContainer) {
        return;
      }

      var isReturned = (statusSelect.value === 'returned');
      returnContainer.style.display = isReturned ? '' : 'none';

      var inputs = returnContainer.querySelectorAll('input, textarea, select');
      for (var i = 0; i < inputs.length; i++) {
        inputs[i].disabled = !isReturned;
      }
    }

    function toggleReturnCustomReason() {
      if (!reasonSelect || !reasonCustom) {
        return;
      }

      var isOther = (reasonSelect.value === 'other');
      reasonCustom.style.display = isOther ? '' : 'none';

      var inputs = reasonCustom.querySelectorAll('input, textarea, select');
      for (var i = 0; i < inputs.length; i++) {
        inputs[i].disabled = !isOther;
      }
    }

    statusSelect.addEventListener('change', function () {
      toggleCourierFields();
      toggleReturnFields();
      toggleReturnCustomReason();
    });

    if (reasonSelect) {
      reasonSelect.addEventListener('change', toggleReturnCustomReason);
    }

    toggleCourierFields();
    toggleReturnFields();
    toggleReturnCustomReason();
  })();
</script>
@endpush
