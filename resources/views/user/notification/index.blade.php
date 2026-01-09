@extends('user.layouts.master')

@section('main-content')
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Notifications</h1>
  </div>

  <div class="card shadow mb-4">
    <div class="card-body">
      @include('user.layouts.notification')

      @if($notifications->count() === 0)
        <div class="text-muted">No notifications.</div>
      @else
        <div class="list-group">
          @foreach($notifications as $notification)
            <a href="{{ route('user.notification', $notification->id) }}" class="list-group-item list-group-item-action">
              <div class="d-flex w-100 justify-content-between">
                <div>
                  <i class="fas {{ $notification->data['fas'] ?? 'fa-bell' }} mr-2"></i>
                  <span class="{{ $notification->read_at ? 'text-muted' : 'font-weight-bold' }}">
                    {{ $notification->data['title'] ?? 'Notification' }}
                  </span>
                </div>
                <small class="text-muted">{{ $notification->created_at->format('M d, Y h:i A') }}</small>
              </div>
            </a>
          @endforeach
        </div>

        <div class="mt-3">
          {{ $notifications->links() }}
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
