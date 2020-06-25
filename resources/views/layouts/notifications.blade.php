<div class="dropdown d-none d-md-flex">
  <a class="nav-link icon" data-toggle="dropdown">
    <i class="fe fe-bell"></i>
    @if( auth()->user()->unreadNotifications->count() > 0 )
    <span class="nav-unread"></span>
    @endif
  </a>

  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
  @forelse( auth()->user()->unreadNotifications as $notification )
    @if( $loop->iteration <= 10 )
    <a href="#" class="dropdown-item d-flex">
      <span class="avatar mr-3 align-self-center">
        @switch($notification->type)
          @case('App\Notifications\DonationReceived')
            <i class="fe fe-dollar-sign"></i>
            @break
          @case('App\Notifications\StateEnabled' || 'App\Notifications\StateDisabled')
            <i class="fe fe-map-pin"></i>
            @break

          @default
            Default case...
        @endswitch

      </span>
      <div>
    @switch($notification->type)
      @case('App\Notifications\DonationReceived')
        <strong>{{ $notification->data['name'] }}</strong> donated ${{ $notification->data['amount'] }}.
        <div class="small text-muted">{{ Carbon\Carbon::parse($notification->data['created_at']['date'])->diffForHumans() }}</div>
        @break

      @case('App\Notifications\StateEnabled')
        <strong>{{ $notification->data['user'] }}</strong> enabled {{ $notification->data['state'] }}.
        <div class="small text-muted">{{ Carbon\Carbon::parse($notification->data['created_at']['date'])->diffForHumans() }}</div>
        @break

      @case('App\Notifications\StateDisabled')
        <strong>{{ $notification->data['user'] }}</strong> disabled {{ $notification->data['state'] }}.
        <div class="small text-muted">{{ Carbon\Carbon::parse($notification->data['created_at']['date'])->diffForHumans() }}</div>
        @break

      @default
        Notification
    @endswitch
      </div>
    </a>
    @else
    <div class="dropdown-item d-flex">
      <span class="avatar mr-3 align-self-center">
        <i class="fe fe-alert-circle"></i>
      </span>
      <div>
        <strong>{{ $loop->remaining }}</strong> other notifications.
        <div class="small text-muted">See all.</div>
      </div>
    </div>
     @break
    @endif
  @empty
    <div class="dropdown-item d-flex">
      <em>No Unread Notifications</em>
    </div>
  @endforelse

  @if( auth()->user()->unreadNotifications->count() > 0 )
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item text-center text-muted-dark">Mark all as read</a>
  @else
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item text-center text-muted-dark">View All</a>
  @endif
  </div>
</div>
