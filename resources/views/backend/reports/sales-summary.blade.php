@extends('backend.layouts.master')

@section('main-content')
<div class="card shadow mb-4">
    <div class="row">
        <div class="col-md-12">
            @include('backend.layouts.notification')
        </div>
    </div>

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Sales Summary Report</h6>
    </div>

    <div class="card-body">
        <form class="form-row mb-3" method="GET" action="{{ route('reports.sales-summary') }}">
            <div class="col-md-3 mb-2">
                <label class="mb-1">Group By</label>
                <select name="group_by" class="form-control">
                    <option value="day" {{ $groupBy === 'day' ? 'selected' : '' }}>Daily</option>
                    <option value="month" {{ $groupBy === 'month' ? 'selected' : '' }}>Monthly</option>
                </select>
            </div>
            <div class="col-md-3 mb-2">
                <label class="mb-1">From</label>
                <input type="date" name="from" class="form-control" value="{{ $from }}">
            </div>
            <div class="col-md-3 mb-2">
                <label class="mb-1">To</label>
                <input type="date" name="to" class="form-control" value="{{ $to }}">
            </div>
            <div class="col-md-3 mb-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary mr-2">Filter</button>
                <a class="btn btn-outline-secondary" href="{{ route('reports.sales-summary') }}">Reset</a>
            </div>

            <div class="col-12 mt-2">
                <a class="btn btn-success mr-2" href="{{ route('reports.sales-summary.excel', ['group_by' => $groupBy, 'from' => $from, 'to' => $to]) }}">Export Excel</a>
                <a class="btn btn-danger" href="{{ route('reports.sales-summary.pdf', ['group_by' => $groupBy, 'from' => $from, 'to' => $to]) }}">Export PDF</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    @if($groupBy === 'month')
                        <tr>
                            <th>Year</th>
                            <th>Month</th>
                            <th>Total Orders</th>
                            <th>Total Revenue</th>
                        </tr>
                    @else
                        <tr>
                            <th>Day</th>
                            <th>Total Orders</th>
                            <th>Total Revenue</th>
                        </tr>
                    @endif
                </thead>
                <tbody>
                    @forelse($rows as $row)
                        @if($groupBy === 'month')
                            <tr>
                                <td>{{ $row->year }}</td>
                                <td>{{ $row->month }}</td>
                                <td>{{ (int) $row->total_orders }}</td>
                                <td>${{ number_format((float) $row->total_revenue, 2) }}</td>
                            </tr>
                        @else
                            <tr>
                                <td>{{ $row->day }}</td>
                                <td>{{ (int) $row->total_orders }}</td>
                                <td>${{ number_format((float) $row->total_revenue, 2) }}</td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="4">No data found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
