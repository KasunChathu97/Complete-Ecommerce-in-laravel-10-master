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

      <div class="form-group">
        <label for="courier_name">Courier Name :</label>
        <input type="text" name="courier_name" class="form-control" value="{{ old('courier_name', $order->courier_name) }}" placeholder="e.g. DHL / FedEx / Local Courier">
      </div>

      <div class="form-group">
        <label for="tracking_number">Tracking Number :</label>
        <input type="text" name="tracking_number" class="form-control" value="{{ old('tracking_number', $order->tracking_number) }}" placeholder="Enter tracking number">
      </div>

      <div class="form-group">
        <label for="status">Status :</label>
        @php
          $currentStatus = old('status', $order->status);
          if ($currentStatus === 'pending') {
            $currentStatus = 'ship';
          }
        @endphp
        <select name="status" id="" class="form-control">
          <option value="new" {{($order->status!='new') ? 'disabled' : ''}}  {{(($currentStatus=='new')? 'selected' : '')}}>New</option>
          <option value="process" {{($order->status=='delivered'|| $order->status=="cancel") ? 'disabled' : ''}}  {{(($currentStatus=='process')? 'selected' : '')}}>process</option>
          <option value="ship" {{($order->status=="delivered"|| $order->status=="cancel") ? 'disabled' : ''}}  {{(($currentStatus=='ship')? 'selected' : '')}}>ship</option>
          <option value="delivered" {{($order->status=="cancel") ? 'disabled' : ''}}  {{(($currentStatus=='delivered')? 'selected' : '')}}>Delivered</option>
          <option value="cancel" {{($order->status=='delivered') ? 'disabled' : ''}}  {{(($currentStatus=='cancel')? 'selected' : '')}}>Cancel</option>
        </select>
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
