@extends('layouts.auth')

@section('content')
<div class="col col-login mx-auto">
  <div class="text-center mb-6">
    <img src="{{ $logo_url }}" class="h-6" alt="">
  </div>
  <div class="card">
    <div class="card-body p-6">
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        {{ __('Before proceeding, please check your email for a verification link.') }}
        {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
    </div>
  </div>
</div>
@endsection
