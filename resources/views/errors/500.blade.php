@extends('layouts.auth')

@section('content')
<div class="container text-center">
  <div class="display-1 text-muted mb-5"><i class="si si-exclamation"></i> 500 Internal Server Error</div>
  <h1 class="h2 mb-3">Oops! An error...</h1>
  <p class="h4 text-muted font-weight-normal mb-7">The server has encountered a situation it doesn't know how to handle.</p>
  <a class="btn btn-primary" href="javascript:history.back()">
    <i class="fe fe-arrow-left mr-2"></i>Go back
  </a>
</div>
@endsection
