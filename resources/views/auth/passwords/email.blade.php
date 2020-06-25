@extends('layouts.auth')

@section('content')
<div class="col col-login mx-auto">
  <div class="text-center mb-6">
    <img src="{{ $logo_url }}" class="h-6" alt="">
  </div>
  {!! Form::open(['method' => 'POST', 'route' => 'password.email', 'class' => 'card']) !!}
    <div class="card-body p-6">
      <div class="card-title">{{ __('Forgot Password') }}</div>
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @else
        <p class="text-muted">Enter your email address and your password will be reset and emailed to you.</p>
      @endif
      <div class="form-group">
        {!! Form::label('email', __('E-Mail Address'), ['class' => 'form-label']) !!}
        {!! Form::text('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Enter email']) !!}

        @if ($errors->has('email'))
        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
        @endif
      </div>
      <div class="form-footer">
        <button type="submit" class="btn btn-primary btn-block">{{ __('Send Password Reset Link') }}</button>
      </div>
    </div>
  {!! Form::close() !!}
  <div class="text-center text-muted">
    Nevermind, <a href="{{ route('login') }}">send me back</a> to the sign in screen.
  </div>
</div>
@endsection
