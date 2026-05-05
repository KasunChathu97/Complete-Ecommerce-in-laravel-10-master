@extends('backend.layouts.master')
@section('title','Sales Admin || DASHBOARD')

@section('main-content')
<div class="container-fluid">
    @include('backend.layouts.notification')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Sales Admin Dashboard</h1>
    </div>

    <div class="row">
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Assigned Orders</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $metrics['assigned_total'] ?? 0 }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Assigned Today</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $metrics['assigned_today'] ?? 0 }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">In Process</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $metrics['status_process'] ?? 0 }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-sync fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Delivered Revenue</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ Helper::formatCurrency((float)($metrics['delivered_revenue'] ?? 0), 2) }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6 mb-4">
        <div class="card shadow">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Assigned Orders by Status</h6>
          </div>
          <div class="card-body">
            <div class="d-flex flex-wrap" style="gap:12px;">
              <span class="badge badge-primary p-2">New: {{ $metrics['status_new'] ?? 0 }}</span>
              <span class="badge badge-info p-2">Pending: {{ $metrics['status_pending'] ?? 0 }}</span>
              <span class="badge badge-warning p-2">Process: {{ $metrics['status_process'] ?? 0 }}</span>
              <span class="badge badge-success p-2">Delivered: {{ $metrics['status_delivered'] ?? 0 }}</span>
              <span class="badge badge-danger p-2">Cancel: {{ $metrics['status_cancel'] ?? 0 }}</span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 mb-4">
        <div class="card shadow">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Quick Links</h6>
          </div>
          <div class="card-body">
            <a href="{{ route('order.index') }}" class="btn btn-primary btn-sm mr-2">My Orders</a>
            <a href="{{ route('sms-logs.index') }}" class="btn btn-outline-secondary btn-sm">SMS Logs</a>
          </div>
        </div>
      </div>
    </div>

    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">My Stock</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Product</th>
                <th style="width:140px;">Quantity</th>
              </tr>
            </thead>
            <tbody>
              @forelse(($allocatedStocks ?? []) as $row)
                <tr>
                  <td>{{ optional($row->product)->title ?? 'Product not found' }}</td>
                  <td><span class="badge badge-primary">{{ (int) $row->quantity }}</span></td>
                </tr>
              @empty
                <tr>
                  <td colspan="2">No stock allocated yet.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Recent Assigned Orders</h6>
        <a class="btn btn-sm btn-outline-primary" href="{{ route('order.index') }}">View All</a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Order No.</th>
                <th>Customer</th>
                <th>Total</th>
                <th>Status</th>
                <th>Date</th>
                <th style="width:90px;">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($recentOrders as $order)
                <tr>
                  <td>{{ $order->order_number }}</td>
                  <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                  <td>{{ Helper::formatCurrency((float)$order->total_amount, 2) }}</td>
                  <td>
                    @if($order->status=='new')
                      <span class="badge badge-primary">{{ $order->status }}</span>
                    @elseif($order->status=='pending')
                      <span class="badge badge-info">{{ $order->status }}</span>
                    @elseif($order->status=='process')
                      <span class="badge badge-warning">{{ $order->status }}</span>
                    @elseif($order->status=='delivered')
                      <span class="badge badge-success">{{ $order->status }}</span>
                    @else
                      <span class="badge badge-danger">{{ $order->status }}</span>
                    @endif
                  </td>
                  <td>{{ optional($order->created_at)->format('Y-m-d') }}</td>
                  <td>
                    <a href="{{ route('order.show', $order->id) }}" class="btn btn-warning btn-sm" title="view"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('order.edit', $order->id) }}" class="btn btn-primary btn-sm" title="edit"><i class="fas fa-edit"></i></a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6">No assigned orders yet.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
@endsection
