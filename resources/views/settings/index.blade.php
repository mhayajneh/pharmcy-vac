@extends('layouts.app')

@section('content')
<div class="row row-cards row-deck">
  <div class="col-12">
    {!! Form::open(['method' => 'POST', 'route' => 'settings.store', 'class' => 'card']) !!}
    {!! Form::hidden('multiple', true) !!}
      <div class="card-body">
        <h3 class="card-title">Edit Campaign Details</h3>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label class="form-label">Campaign Name</label>
              <input name="campaign[name]" type="text" class="form-control" value="{{ $campaign->name }}" placeholder="Campaign {{ now()->format('Y') }}">
              <small class="form-text text-muted">Name is not exact, results containing the name will match.</small>
            </div>
          </div>
          <div class="col-sm-6 col-md-4">
            <div class="form-group">
              <label class="form-label">Start Date</label>
              <input name="campaign[start_date]" type="text" class="form-control" value="{{ $campaign->start_date }}" placeholder="{{ now()->format('m/d/Y') }}">
              <small class="form-text text-muted">Date for first transactions. Formatted as Month\Day\Year.</small>
            </div>
          </div>
          <div class="col-sm-6 col-md-4">
            <div class="form-group">
              <label class="form-label">End Date</label>
              <input name="campaign[end_date]" type="text" class="form-control" value="{{ $campaign->end_date }}" placeholder="{{ now()->addMonths(3)->format('m/d/Y') }}">
              <small class="form-text text-muted">Date for last transactions. Formatted as Month\Day\Year.</small>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
          <div class="form-group">
            <div class="form-label">Privacy Settings</div>
              <label class="custom-switch">
              {!! Form::hidden('campaign[privacy]', 0) !!}
              {!! Form::checkbox('campaign[privacy]', 1, $campaign->privacy, ['class' => "custom-switch-input"]) !!}
              <span class="custom-switch-indicator"></span>
              <span class="custom-switch-description">Hide private donation details.</span>
            </label>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary btn-sm">Update Campaign</button>
      </div>
    </form>
  </div>
</div>

<div class="row row-cards row-deck">
  <div class="col-12">
    <div class="card">
      <div class="table-responsive">
        <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
          <thead>
            <tr>
              <th>Task Name</th>
              <th>Description</th>
              <th>Activity</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <div>Clear Imports</div>
                <div class="small text-muted">Delete imported donations.</div>
              </td>
              <td>
                <div>Delete imported donations. New donations will be imported based on the selected filters.</div>
              </td>
              <td>
                <div>Manual Task</div>
                <div class="small text-muted">On Demand</div>
              </td>
              <td>
                {!! Form::open(['method' => 'PUT', 'route' => ['tasks.run', 'clear-imports']]) !!}
                <button type="submit" href="#" class="btn btn-outline-primary btn-sm">
                  Run<i class="fe fe-play ml-2"></i>
                </button>
                {!! Form::close() !!}
              </td>
            </tr>
            <tr>
              <td>
                <div>Import Donations</div>
                <div class="small text-muted">From MobileCause API.</div>
              </td>
              <td>
                <div>Import donations from MobileCause using selected Campaign filters.</div>
              </td>
              <td>
                <div>Scheduled Task</div>
                <div class="small text-muted">Every 5 Minutes</div>
              </td>
              <td>
                {!! Form::open(['method' => 'PUT', 'route' => ['tasks.run', 'import']]) !!}
                <button type="submit" href="#" class="btn btn-outline-primary btn-sm">
                  Run<i class="fe fe-play ml-2"></i>
                </button>
                {!! Form::close() !!}
              </td>
            </tr>
          </tbody>
        </table>
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
              <th>Other Settings</th>
              <th>Description</th>
              <th>Last Activity</th>
              <th class="text-center"><i class="fe fe-settings"></i></th>
            </tr>
          </thead>
          <tbody>
          @foreach( $settings as $setting )
            <tr>
              <td>
                <div>{{ $setting->key }}</div>
                <div class="small text-muted">
                  {{ $setting->value }}
                </div>
              </td>
              <td>
                <div>{{ $setting->description }}</div>
              </td>
              <td>
              @if($setting->created_at == $setting->updated_at)
                <div class="small text-muted">Created</div>
              @else
                <div class="small text-muted">Updated</div>
              @endif
                <div>{{ $setting->updated_at->diffForHumans() }}</div>
              </td>
              <td class="text-center">
                <div class="item-action dropdown">
                  <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                  <div class="dropdown-menu">
                    <a href="{{ route('settings.edit', $setting )}}" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Edit </a>
                  </div>
                </div>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-footer text-right">
        <div class="d-flex">
          <a href="{{ route('settings.create') }}" class="btn btn-primary btn-sm ml-auto">Create New</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
