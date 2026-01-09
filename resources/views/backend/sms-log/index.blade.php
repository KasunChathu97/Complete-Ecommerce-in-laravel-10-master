@extends('backend.layouts.master')

@section('main-content')
<div class="card shadow mb-4">
    <div class="row">
        <div class="col-md-12">
            @include('backend.layouts.notification')
        </div>
    </div>

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">SMS Logs</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            @if($smsLogs->count() > 0)
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Provider</th>
                            <th>Sent At</th>
                            <th>Order</th>
                            <th>Created By</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($smsLogs as $log)
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td>{{ $log->phone }}</td>
                                <td>{{ $log->status }}</td>
                                <td>{{ $log->provider ?? '-' }}</td>
                                <td>{{ optional($log->sent_at ?? $log->created_at)->format('Y-m-d H:i') ?? '-' }}</td>
                                <td>
                                    @if($log->order)
                                        <a href="{{ route('order.show', $log->order->id) }}">{{ $log->order->order_number }}</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ optional($log->creator)->name ?? '-' }}</td>
                                <td style="max-width: 360px; white-space: normal;">{{ $log->message }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <span style="float:right">{{ $smsLogs->links() }}</span>
            @else
                <h6 class="text-center">No SMS logs found.</h6>
            @endif
        </div>
    </div>
</div>
@endsection
