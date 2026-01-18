@extends('backend.layouts.master')

@section('main-content')
<div class="card shadow mb-4">
    <div class="row">
        <div class="col-md-12">
            @include('backend.layouts.notification')
        </div>
    </div>

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Wholesale Requests</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            @if($wholesaleRequests->count() > 0)
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Company</th>
                            <th>Qty</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th style="width: 220px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($wholesaleRequests as $req)
                            <tr>
                                <td>{{ $req->id }}</td>
                                <td>
                                    @if($req->product)
                                        <a href="{{ route('product.edit', $req->product->id) }}">{{ $req->product->title }}</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $req->name }}</td>
                                <td><a href="mailto:{{ $req->email }}">{{ $req->email }}</a></td>
                                <td>{{ $req->phone }}</td>
                                <td>{{ $req->company ?? '-' }}</td>
                                <td>{{ $req->quantity ?? '-' }}</td>
                                <td>
                                    @php
                                        $status = strtolower((string) $req->status);
                                        $badge = 'secondary';
                                        if ($status === 'new') $badge = 'primary';
                                        if ($status === 'contacted') $badge = 'info';
                                        if ($status === 'closed') $badge = 'success';
                                    @endphp
                                    <span class="badge badge-{{ $badge }}">{{ $req->status }}</span>
                                </td>
                                <td>{{ optional($req->created_at)->format('Y-m-d H:i') }}</td>
                                <td>
                                    <form method="post" action="{{ route('wholesale-requests.update', $req->id) }}" style="display:inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="contacted">
                                        <button type="submit" class="btn btn-sm btn-outline-info">Mark Contacted</button>
                                    </form>

                                    <form method="post" action="{{ route('wholesale-requests.update', $req->id) }}" style="display:inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="closed">
                                        <button type="submit" class="btn btn-sm btn-outline-success">Close</button>
                                    </form>

                                    <form method="post" action="{{ route('wholesale-requests.destroy', $req->id) }}" style="display:inline-block;" onsubmit="return confirm('Delete this wholesale request?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <span style="float:right">{{ $wholesaleRequests->links() }}</span>
            @else
                <h6 class="text-center">No wholesale requests found.</h6>
            @endif
        </div>
    </div>
</div>
@endsection
