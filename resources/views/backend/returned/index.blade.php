@extends('backend.layouts.master')

@section('main-content')
<div class="card shadow mb-4">
  <div class="row">
    <div class="col-md-12">
      @include('backend.layouts.notification')
    </div>
  </div>

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary float-left">Returned Items</h6>
  </div>

  <div class="card-body">
    <div class="d-flex flex-wrap align-items-end justify-content-between mb-3" style="gap: 12px;">
      <form action="{{ route('returned-items.index') }}" method="GET" class="d-flex flex-wrap align-items-end" style="gap: 10px;">
        <div>
          <label for="returned_date" class="mb-1"><small>Returned date</small></label>
          <input type="date" id="returned_date" name="date" value="{{ request('date', $date ?? '') }}" class="form-control" style="min-width: 180px;" />
        </div>
        <div>
          <label for="returned_q" class="mb-1"><small>Order No / Product / Phone</small></label>
          <input type="text" id="returned_q" name="q" value="{{ request('q', $q ?? '') }}" class="form-control" style="min-width: 260px;" placeholder="Search..." autocomplete="off" />
        </div>
        <div class="d-flex" style="gap: 8px;">
          <button type="submit" class="btn btn-primary">Filter</button>
          <a href="{{ route('returned-items.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
      </form>
    </div>

    <div class="table-responsive">
      @if($items->count() > 0)
      <table class="table table-bordered" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>S.N.</th>
            <th>Order No.</th>
            <th>Customer</th>
            <th>Phone</th>
            <th>Sales Admin</th>
            <th>Product</th>
            <th>Qty</th>
            <th>Order Total</th>
            <th>Returned At</th>
            <th>Reason</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($items as $item)
          <tr>
            <td>{{ $item->order_id }}</td>
            <td>{{ $item->order_number }}</td>
            <td>{{ trim(($item->first_name ?? '').' '.($item->last_name ?? '')) ?: '-' }}</td>
            <td>{{ $item->phone ?? '-' }}</td>
            <td>{{ $item->sales_admin_name ?? '-' }}</td>
            <td>{{ $item->product_title ?? ('#'.$item->product_id) }}</td>
            <td>{{ $item->returned_qty }}</td>
            <td>{{ Helper::formatCurrency($item->total_amount, 2) }}</td>
            <td>{{ $item->returned_at ? \Carbon\Carbon::parse($item->returned_at)->format('Y-m-d H:i') : '-' }}</td>
            <td style="max-width: 320px; white-space: normal;">{{ $item->return_reason ?? '-' }}</td>
            <td>
              <a href="{{ route('order.show', $item->order_id) }}" class="btn btn-warning btn-sm mr-1" data-toggle="tooltip" title="view" data-placement="bottom"><i class="fas fa-eye"></i></a>
              <a href="{{ route('order.edit', $item->order_id) }}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <span style="float:right">{{ $items->links() }}</span>
      @else
        <h6 class="text-center">No returned items found.</h6>
      @endif
    </div>
  </div>
</div>
@endsection
