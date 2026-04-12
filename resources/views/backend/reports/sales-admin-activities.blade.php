@extends('backend.layouts.master')

@section('main-content')
<div class="card shadow mb-4">
    <div class="row">
        <div class="col-md-12">
            @include('backend.layouts.notification')
        </div>
    </div>

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Sales Admin Activities</h6>
    </div>

    <div class="card-body">
        @php
            $filters = $filters ?? [];
        @endphp

        <form class="form-row mb-3" method="GET" action="{{ route('reports.sales-admin-activities') }}">
            <div class="col-md-3 mb-2">
                <label class="mb-1">Date</label>
                <input type="date" name="date" class="form-control" value="{{ $filters['date'] ?? '' }}">
            </div>

            <div class="col-md-5 mb-2">
                <label class="mb-1">Sales Admin</label>
                <select name="sales_admin_id" class="form-control">
                    <option value="">All</option>
                    @foreach(($salesAdmins ?? []) as $sa)
                        <option value="{{ $sa->id }}" {{ (string)($filters['sales_admin_id'] ?? '') === (string)$sa->id ? 'selected' : '' }}>
                            {{ $sa->name }} ({{ $sa->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 mb-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary mr-2">Filter</button>
                <a class="btn btn-outline-secondary" href="{{ route('reports.sales-admin-activities') }}">Reset</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sales Admin</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Total Orders</th>
                        <th>Given Qty</th>
                        <th>Sold Qty</th>
                        <th>Total Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rows as $row)
                        <tr>
                            <td>{{ $row->sales_admin_name ?? '-' }}</td>
                            <td>{{ $row->sales_admin_email ?? '-' }}</td>
                            <td>{{ $row->sales_admin_phone ?? '-' }}</td>
                            <td>{{ (int) $row->total_orders }}</td>
                            <td>{{ (int) ($row->given_qty ?? 0) }}</td>
                            <td>{{ (int) ($row->sold_qty ?? 0) }}</td>
                            <td>${{ number_format((float) $row->total_revenue, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">No data found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(!empty($filters['sales_admin_id']))
            <hr>
            <h6 class="m-0 font-weight-bold text-primary mb-3">Items (Selected Sales Admin)</h6>

            <div class="card mb-3">
                <div class="card-body">
                    <h6 class="font-weight-bold text-primary mb-3">Transfer Stock to This Sales Admin</h6>
                    <form method="POST" action="{{ route('reports.sales-admin-activities.transfer-stock') }}" id="transfer-stock-form">
                        @csrf
                        <input type="hidden" name="sales_admin_id" value="{{ $filters['sales_admin_id'] }}">

                        <div class="form-row">
                            <div class="col-md-6 mb-2">
                                <label class="mb-1">Product</label>
                                <select class="form-control" name="product_id" id="transfer_product_id" data-stock-url-template="{{ url('/admin/product') }}/__ID__/admin-stock" required>
                                    <option value="">-- Select Product --</option>
                                    @foreach(($products ?? []) as $p)
                                        <option value="{{ $p->id }}" {{ (string) old('product_id') === (string) $p->id ? 'selected' : '' }}>
                                            {{ $p->title }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted d-block mt-1">Available Admin Stock: <strong id="transfer_available_stock">-</strong></small>
                                @error('product_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-2">
                                <label class="mb-1">Quantity</label>
                                <input type="number" min="1" class="form-control" name="quantity" value="{{ old('quantity') }}" required>
                                @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary w-100">Transfer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                (function () {
                    var select = document.getElementById('transfer_product_id');
                    var stockEl = document.getElementById('transfer_available_stock');
                    if (!select || !stockEl) return;

                    function setStockText(text) {
                        stockEl.textContent = text;
                    }

                    async function updateStock() {
                        var productId = select.value;
                        if (!productId) {
                            setStockText('-');
                            return;
                        }

                        var template = select.getAttribute('data-stock-url-template') || '';
                        var url = template.replace('__ID__', encodeURIComponent(productId));
                        if (!url) {
                            setStockText('-');
                            return;
                        }

                        setStockText('...');
                        try {
                            var res = await fetch(url, { headers: { 'Accept': 'application/json' } });
                            if (!res.ok) {
                                setStockText('-');
                                return;
                            }
                            var data = await res.json();
                            setStockText(String((data && data.admin_stock != null) ? data.admin_stock : '-'));
                        } catch (e) {
                            setStockText('-');
                        }
                    }

                    select.addEventListener('change', updateStock);
                    updateStock();
                })();
            </script>

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
                        @forelse(($itemRows ?? []) as $row)
                            <tr>
                                <td>{{ $row->product ?? '-' }}</td>
                                <td>{{ $row->sold_date ?? '-' }}</td>
                                <td>
                                    @if($row->purchase_price === null)
                                        -
                                    @else
                                        ${{ number_format((float) $row->purchase_price, 2) }}
                                    @endif
                                </td>
                                <td>${{ number_format((float) $row->sale_price, 2) }}</td>
                                <td>{{ (int) ($row->total_qty ?? 0) }}</td>
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
                                <td colspan="7">No item data found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @else
            <hr>
            <div class="alert alert-info mb-0">
                Select a Sales Admin to view item-wise quantities.
            </div>
        @endif
    </div>
</div>
@endsection
