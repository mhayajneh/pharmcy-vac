@extends('layouts.app')

@section('content')
<div class="row row-cards row-deck">
  <div class="col-lg-6">
    <div class="card">
      <div class="card-body">
        {!! Form::model($setting, ['method' => 'PUT', 'route' => ['settings.update', $setting]]) !!}
          <div class="row">
            <div class="col">
              <div class="form-group">
                {!! Form::label('key', 'Setting Key', ['class' => 'form-label']) !!}
                {!! Form::text('key', null, ['class' => 'form-control', 'placeholder' => 'new.setting']) !!}
              </div>
            </div>
          </div>
          <div class="form-group">
            {!! Form::label('description', 'Description', ['class' => 'form-label']) !!}
            {!! Form::textarea ('description', null, ['class' => 'form-control', 'rows' => 5]) !!}
          </div>
          <div class="form-group">
            {!! Form::label('value', 'Setting Value', ['class' => 'form-label']) !!}
            {!! Form::text('value', null, ['class' => 'form-control', 'placeholder' => 'jnfqon afeno aen eaf']) !!}
          </div>
          <div class="row align-items-center">
            <div class="col-auto">
              <span class="avatar avatar-md avatar">{{ auth()->user()->initials }}</span>
            </div>
            <div class="col">
              <div>{{ auth()->user()->name }}</div>
              <small class="d-block item-except text-sm text-muted h-1x">{{ auth()->user()->email }}</small>
            </div>
          </div>
          <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-block">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
