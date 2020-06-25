@extends('layouts.app')

@section('content')
<div class="row row-cards">
  <div class="col-sm-6 col-lg-4">
    <div class="card p-3">
      <div class="d-flex align-items-center">
        <span class="stamp stamp-md bg-blue mr-3">
          <i class="fe fe-hash"></i>
        </span>
        <div>
          <h4 class="m-0">{{ $states->filter(function($state) { return $state->donations->isEmpty(); })->count() }}</h4>
          <small class="text-muted">States without donations</small>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-4">
    <div class="card p-3">
      <div class="d-flex align-items-center">
        <span class="stamp stamp-md bg-blue mr-3">
          <i class="fe fe-award"></i>
        </span>
        <div>
          <h4 class="m-0">{{ $states->sortByDesc(function ($state) { return $state->donations->sum('amount'); })->first()->name }}</h4>
          <small class="text-muted">Most donations</small>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-4">
    <div class="card p-3">
      <div class="d-flex align-items-center">
        <span class="stamp stamp-md bg-blue mr-3">
          <i class="fe fe-award"></i>
        </span>
        <div>
          <h4 class="m-0">{{ $states->sortByDesc('donations_count')->first()->name }}</h4>
          <small class="text-muted">Most donated</small>
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
              <th>State</th>
              <th>Donations</th>
              <th>Donation Activity</th>
              <th class="w-1">Visible</th>
              <th class="w-1 text-center"><i class="fe fe-settings"></i></th>
            </tr>
          </thead>
          <tbody>
          @foreach( $states as $state )
            <tr>
              <td class="w-1">
                <div>{{ $state->abbreviation }}</div>
                <div class="small text-muted">
                  {{ $state->name }}
                </div>
              </td>
              <td>
              @if( $state->donations_count > 0 )
                <div class="clearfix">
                  <div class="float-left">
                    <strong>${{ number_format($state->donations->sum('amount'), 2) }}</strong>
                  </div>
                  <div class="float-right">
                    <small class="text-muted">{{ $state->donations_count }} Donations</small>
                  </div>
                </div>
                <div class="progress progress-xs">
                  <div class="progress-bar bg-success" role="progressbar" style="width: {{ $state->donations->sum('amount') * 100 / $donation_amount }}%" aria-valuenow="{{ $state->donations->sum('amount') * 100 / $donation_amount }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              @else
                <div class="clearfix">
                  <div class="float-left">
                    <strong>$0.00</strong>
                  </div>
                  <div class="float-right">
                    <small class="text-muted">No Donations</small>
                  </div>
                </div>
                <div class="progress progress-xs">
                  <div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              @endif
              </td>
              <td class="w-1">
              @if( $state->donations_count > 0 )
                <div>{{ $state->donations()->latest()->first()->created_at->diffForHumans() }}</div>
                <div class="small text-muted">
                  Last Donation
                </div>
              @endif
              </td>
              <td class="w-1">
                {!! Form::model($state, ['method' => 'PATCH', 'route' => ['states.update', $state]]) !!}
                <div class="form-group m-0">
                  @if( $state->donations->isNotEmpty() )
                    <label class="custom-switch disabled" title="Cannot hide a state which has donations.">
                  @else
                    <label class="custom-switch">
                  @endif
                    {!! Form::hidden('is_visible', 0) !!}
                    {!! Form::checkbox('is_visible', 1, null, ['class' => "custom-switch-input", 'disabled' => $state->donations->isNotEmpty()]) !!}
                    <span class="custom-switch-indicator"></span>
                  </label>
                </div>
                {!! Form::close() !!}
              </td>
              <td class="w-1 text-center">
                <div class="item-action dropdown">
                  <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                  <div class="dropdown-menu">
                    <a href="{{ route('states.show', $state) }}" class="dropdown-item"><i class="dropdown-icon fe fe-activity"></i> View</a>
                    <a href="javascript:void(0)" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Edit</a>
                  </div>
                </div>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
  $(function(){
    $(':checkbox').each(function() {
      $(this).change(function() {
        var $form = $(this).closest("form");

        $form.submit();

        console.log($form);
      });
    });
  });
</script>
@endsection
