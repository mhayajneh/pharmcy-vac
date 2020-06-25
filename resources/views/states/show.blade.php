@extends('layouts.app')

@section('content')
<div class="row row-cards">
  <div class="col-sm-6 col-lg-3">
    <div class="card p-3">
      <div class="d-flex align-items-center">
        <span class="stamp stamp-md bg-blue mr-3">
          <i class="fe fe-hash"></i>
        </span>
        <div>
          <h4 class="m-0">{{ $state->donations->count() }}</h4>
          <small class="text-muted">Total Donations</small>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-3">
    <div class="card p-3">
      <div class="d-flex align-items-center">
        <span class="stamp stamp-md bg-blue mr-3">
          <i class="fe fe-dollar-sign"></i>
        </span>
        <div>
          <h4 class="m-0">${{ $state->donations ? number_format($state->donations->sum('amount'), 2) : 0 }}</h4>
          <small class="text-muted">Amount Donated</small>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-3">
    <div class="card p-3">
      <div class="d-flex align-items-center">
        <span class="stamp stamp-md bg-blue mr-3">
          <i class="fe fe-dollar-sign"></i>
        </span>
        <div>
          <h4 class="m-0">${{ $state->donations ? number_format($state->donations->avg('amount'), 2) : 0 }}</h4>
          <small class="text-muted">Average Donation</small>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-3">
    <div class="card p-3">
      <div class="d-flex align-items-center">
        <span class="stamp stamp-md bg-blue mr-3">
          <i class="fe fe-dollar-sign"></i>
        </span>
        <div>
        @if($state->donations->isNotEmpty())
          <h4 class="m-0">${{ number_format($state->donations->sortByDesc('amount')->first()->amount) }}</h4>
          <small class="text-muted">Largest from {{ $state->donations->sortByDesc('amount')->first()->name }}</small>
        @else
          <h4 class="m-0">$0</h4>
          <small class="text-muted">Largest from <em>N/A</em></small>
        @endif
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row row-cards row-deck">
  <div class="col-12">
    <div class="card">
      <div class="table-responsive">
        <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
          <thead>
            <tr>
              <th>Name</th>
              <th>Date</th>
              <th>City</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            @forelse($state->donations as $donation)
            <tr>
              <td>
                <div>{{ $donation->name }}</div>
                <div class="small text-muted">
                  {{ $donation->email }}
                </div>
              </td>
              <td>
                <div>{{ $donation->created_at->toFormattedDateString() }}</div>
                <div class="small text-muted">
                  {{ $donation->created_at->format('g:i:s A') }}
                </div>
              </td>
              <td>
                <div>
                  {{ $donation->city }} {{ $donation->zip }}
                </div>
                <div class="small text-muted">{{ $donation->state->name }}</div>
              </td>
              <td>
                <div>${{ $donation->amount }}</div>
                <div class="small text-muted">
                  {{ $donation->source }}
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td class="text-center" colspan="4">
                <div>No donations for {{ $state->name }}</div>
                <div class="small text-muted">
                  Get workin' on it!
                </div>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
