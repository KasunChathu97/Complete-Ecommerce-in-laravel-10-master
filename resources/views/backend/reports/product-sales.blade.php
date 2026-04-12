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
        @php
            $filters = $filters ?? [];
            $exportParams = array_filter([
                'date' => $filters['date'] ?? null,
                'product' => $filters['product'] ?? null,
                'category_id' => $filters['category_id'] ?? null,
                'status' => $filters['status'] ?? 'delivered',
            ], fn ($v) => $v !== null && $v !== '');
        @endphp

        <form class="form-row mb-3" method="GET" action="{{ route('reports.product-sales') }}">
            <div class="col-md-2 mb-2">
                <label class="mb-1">Date</label>
                <input type="date" name="date" class="form-control" value="{{ $filters['date'] ?? '' }}">
            </div>

            <div class="col-md-3 mb-2">
                <label class="mb-1">Product</label>
                <input type="text" name="product" class="form-control" placeholder="Search by title" value="{{ $filters['product'] ?? '' }}">
            </div>

            <div class="col-md-3 mb-2">
                <label class="mb-1">Category</label>
                <select name="category_id" class="form-control">
                    <option value="">All</option>
                    @foreach(($categories ?? []) as $cat)
                        <option value="{{ $cat->id }}" {{ (string)($filters['category_id'] ?? '') === (string)$cat->id ? 'selected' : '' }}>
                            {{ $cat->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 mb-2">
                <label class="mb-1">Status</label>
                <select name="status" class="form-control">
                    @php $status = (string) ($filters['status'] ?? 'delivered'); @endphp
                    <option value="delivered" {{ $status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="in_process" {{ $status === 'in_process' ? 'selected' : '' }}>In Process</option>
                </select>
            </div>

            <div class="col-md-2 mb-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary mr-2">Filter</button>
                <a class="btn btn-outline-secondary" href="{{ route('reports.product-sales') }}">Reset</a>
            </div>
        </form>

        <div class="mb-3">
            <a class="btn btn-success mr-2" href="{{ route('reports.product-sales.excel', $exportParams) }}">Export Excel</a>
            <a class="btn btn-danger" href="{{ route('reports.product-sales.pdf', $exportParams) }}">Export PDF</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Sold Date</th>
                        <th>Purchase Price</th>
                        <th>Sales Price</th>
                        <th>Total Qty</th>
                        <th>Total Price</th>
                        <th>Profit</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rows as $row)
                        <tr>
                            <td>{{ $row->product }}</td>
                            <td>{{ $row->sold_date ?? '-' }}</td>
                            <td>
                                @if($row->purchase_price === null)
                                    -
                                @else
                                    ${{ number_format((float) $row->purchase_price, 2) }}
                                @endif
                            </td>
                            <td>${{ number_format((float) $row->sale_price, 2) }}</td>
                            <td>{{ (int) $row->total_qty }}</td>
                            <td>${{ number_format((float) $row->total_price, 2) }}</td>
                            <td>
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
        </div>
    </div>
</div>
@endsection
