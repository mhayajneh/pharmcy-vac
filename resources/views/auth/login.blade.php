@extends('layouts.auth')

@section('content')
<div class="col col-login mx-auto">
  <div class="text-center mb-6">
    <img src="{{ $logo_url }}" class="h-6" alt="">
  </div>
  {!! Form::open(['method' => 'POST', 'route' => 'login', 'class' => 'card']) !!}
    <div class="card-body p-6">
      <div class="card-title">Login to your account</div>
      <div class="form-group">
        {!! Form::label('email', 'Email address', ['class' => 'form-label']) !!}
        {!! Form::text('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Enter email']) !!}

        @if ($errors->has('email'))
        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
        @endif
      </div>
      <div class="form-group">
        <label class="form-label">Password <a href="{{ route('password.request') }}" class="float-right small">I forgot password</a> </label>
        {!! Form::password('password', ['class' => 'form-control' . ($errors->has('password ') ? ' is-invalid' : ''), 'placeholder' => 'Password']) !!}

        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group">
        <label class="custom-switch">
          <input type="checkbox" name="remember" class="custom-switch-input" {{ old('remember') ? 'checked' : '' }}>
          <span class="custom-switch-indicator"></span>
          <span class="custom-switch-description">Remember me</span>
        </label>
      </div>
      <div class="form-footer">
        <button type="submit" class="btn btn-primary btn-block">Log in</button>
      </div>
    </div>
  {!! Form::close() !!}
  <div class="text-center text-muted">
    Don't have account yet? <a href="{{ route('register') }}">Sign up</a>
  </div>
</div>
@endsection
