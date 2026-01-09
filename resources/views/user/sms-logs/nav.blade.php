<div id="user-sms-logs">
  <a class="nav-link dropdown-toggle" href="#" id="userSmsLogsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-sms fa-fw"></i>
    <span class="badge badge-danger badge-counter">
      @if(($userSmsLogFailedCount ?? 0) > 99)
        <span class="count" data-count="99">99+</span>
      @else
        <span class="count" data-count="{{ $userSmsLogFailedCount ?? 0 }}">{{ $userSmsLogFailedCount ?? 0 }}</span>
      @endif
    </span>
  </a>

  <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userSmsLogsDropdown">
    <h6 class="dropdown-header">SMS Logs</h6>

    @forelse(($recentUserSmsLogs ?? collect()) as $log)
      @php
        $status = $log->status ?: 'pending';
        $bg = $status === 'failed' ? 'bg-danger' : ($status === 'sent' ? 'bg-success' : 'bg-secondary');
      @endphp

      <a class="dropdown-item d-flex align-items-center" href="{{ route('user.sms-logs.index') }}">
        <div class="mr-3">
          <div class="icon-circle {{ $bg }}">
            <i class="fas fa-sms text-white"></i>
          </div>
        </div>
        <div>
          <div class="small text-gray-500">{{ optional($log->created_at)->format('F d, Y h:i A') }}</div>
          <span class="font-weight-bold">{{ $log->phone }}</span>
          <span class="small text-gray-500">({{ $status }})</span>
        </div>
      </a>
    @empty
      <div class="dropdown-item small text-gray-500">No SMS logs yet</div>
    @endforelse

    <a class="dropdown-item text-center small text-gray-500" href="{{ route('user.sms-logs.index') }}">Show All SMS Logs</a>
  </div>
</div>
