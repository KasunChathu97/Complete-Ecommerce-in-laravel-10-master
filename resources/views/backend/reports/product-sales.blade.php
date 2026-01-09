@extends('backend.layouts.master')

@section('main-content')
<div class="card shadow mb-4">
    <div class="row">
        <div class="col-md-12">
            @include('backend.layouts.notification')
        </div>
    </div>

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Product-wise Sales Report</h6>
    </div>

    <div class="card-body">
        <form class="form-row mb-3" method="GET" action="{{ route('reports.product-sales') }}">
            <div class="col-md-3 mb-2">
                <label class="mb-1">From</label>
                <input type="date" name="from" class="form-control" value="{{ $from }}">
            </div>
            <div class="col-md-3 mb-2">
                <label class="mb-1">To</label>
                <input type="date" name="to" class="form-control" value="{{ $to }}">
            </div>
            <div class="col-md-6 mb-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary mr-2">Filter</button>
                <a class="btn btn-outline-secondary mr-2" href="{{ route('reports.product-sales') }}">Reset</a>

                <a class="btn btn-success mr-2" href="{{ route('reports.product-sales.excel', ['from' => $from, 'to' => $to]) }}">Export Excel</a>
                <a class="btn btn-danger" href="{{ route('reports.product-sales.pdf', ['from' => $from, 'to' => $to]) }}">Export PDF</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Total Qty</th>
                        <th>Total Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rows as $row)
                        <tr>
                            <td>{{ $row->product }}</td>
                            <td>{{ (int) $row->total_qty }}</td>
                            <td>${{ number_format((float) $row->total_revenue, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No data found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
