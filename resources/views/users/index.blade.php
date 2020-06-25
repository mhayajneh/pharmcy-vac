@extends('layouts.app')

@section('content')
<div class="row row-cards row-deck">
  <div class="col-12">
    <div class="card">
      <div class="table-responsive">
        <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Verified On</th>
              <th class="text-center"><i class="fe fe-settings"></i></th>
            </tr>
          </thead>
          <tbody>
          @foreach( $users as $user )
            <tr>
              <td>
                <div>{{ $user->name }}</div>
              </td>
              <td>
                <div>{{ $user->email }}</div>
              </td>
              <td>{{ $user->email_verified_at }}</td>
              <td class="text-center">
                <div class="item-action dropdown">
                  <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                  <div class="dropdown-menu">
                    <a href="{{ route('users.edit', $user )}}" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Edit</a>
                    <a href="{{ route('users.edit', $user )}}" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Activate</a>
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
          <a href="{{ route('settings.create') }}" class="btn btn-primary ml-auto">Create New</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-table">

          <table class="table table-striped table-borderless">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Verified On</th>
              </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
              <tr>
                <th scope="row">{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->email_verified_at }}</td>
                <td></td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
