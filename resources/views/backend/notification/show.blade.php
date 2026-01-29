<div id="notifications">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        @php $unreadCount = Auth::check() ? count(Auth::user()->unreadNotifications) : 0; @endphp
        <i class="fas fa-bell fa-fw @if($unreadCount>0) notify-bell-animate @endif"></i>
        <!-- Counter - Alerts -->
        <span class="badge badge-danger badge-counter">
            @if($unreadCount >5 )<span data-count="5" class="count">5+</span>
            @else 
                <span class="count" data-count="{{$unreadCount}}">{{$unreadCount}}</span>
            @endif
        </span>
      </a>
      <!-- Dropdown - Alerts -->
      <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
          Notifications Center
        </h6>
        @if($unreadCount>0)
            <div class="dropdown-item text-center small text-gray-500">You have some notifications</div>
        @endif
        @if(Auth::check())
            @foreach(Auth::user()->unreadNotifications as $notification)
    <a class="dropdown-item d-flex align-items-center" target="_blank" href="{{route('admin.notification',$notification->id)}}">
                <div class="mr-3">
                    <div class="icon-circle bg-primary">
                    <i class="fas {{$notification->data['fas']}} text-white"></i>
                    </div>
                </div>
                <div>
                    <div class="small text-gray-500">{{$notification->created_at->format('F d, Y h:i A')}}</div>
                    <span class="@if($notification->unread()) font-weight-bold @else small text-gray-500 @endif">{{$notification->data['title']}}</span>
                </div>
            </a>
                @if($loop->index+1==5)
                @php 
                    break;
                @endphp
            @endif
            @endforeach
        @endif

        <a class="dropdown-item text-center small text-gray-500" href="{{route('all.notification')}}">Show All Notifications</a>
      </div>
</div>

<style>
    @keyframes notifyBellShake {
        0%, 100% { transform: rotate(0deg); }
        10% { transform: rotate(-10deg); }
        20% { transform: rotate(10deg); }
        30% { transform: rotate(-10deg); }
        40% { transform: rotate(10deg); }
        50% { transform: rotate(-6deg); }
        60% { transform: rotate(6deg); }
        70% { transform: rotate(-3deg); }
        80% { transform: rotate(3deg); }
    }
    .notify-bell-animate {
        display: inline-block;
        transform-origin: top center;
        animation: notifyBellShake 1.1s ease-in-out infinite;
    }
</style>