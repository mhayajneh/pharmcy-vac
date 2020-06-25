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
          <h4 class="m-0">{{ $total_pharmacy }}</h4>
          <small class="text-muted">Total Pharmacies</small>
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
          <h4 class="m-0">{{ $user_count }}</h4>
          <small class="text-muted">Total Users</small>
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
          <h4 class="m-0">{{ $total_trainings }}</h4>
          <small class="text-muted">Total Trainings</small>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
