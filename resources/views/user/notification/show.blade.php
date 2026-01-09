<div id="user-notifications">
  <a class="nav-link dropdown-toggle" href="#" id="userAlertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-bell fa-fw"></i>
    <span class="badge badge-danger badge-counter">
      @php($unread = Auth::user()->unreadNotifications)
      @if(count($unread) > 5)
        <span class="count" data-count="5">5+</span>
      @else
        <span class="count" data-count="{{ count($unread) }}">{{ count($unread) }}</span>
      @endif
    </span>
  </a>

  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userAlertsDropdown">
    <h6 class="dropdown-header">Notifications</h6>

    @foreach($unread as $notification)
      <a class="dropdown-item d-flex align-items-center" href="{{ route('user.notification', $notification->id) }}">
        <div class="mr-3">
          <div class="icon-circle bg-primary">
            <i class="fas {{ $notification->data['fas'] ?? 'fa-bell' }} text-white"></i>
          </div>
        </div>
        <div>
          <div class="small text-gray-500">{{ $notification->created_at->format('F d, Y h:i A') }}</div>
          <span class="font-weight-bold">{{ $notification->data['title'] ?? 'Notification' }}</span>
        </div>
      </a>

      @if($loop->index + 1 == 5)
        @break
      @endif
    @endforeach

    <a class="dropdown-item text-center small text-gray-500" href="{{ route('user.notifications') }}">Show All Notifications</a>
  </div>
</div>
