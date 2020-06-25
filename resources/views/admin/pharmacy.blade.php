@extends('layouts.app')

@section('content')

    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div>
                    <h3 style="padding: 10px;display: inline-block;"> List of Pharmacies </h3>
                    @if(isset(\Auth::user()->type) && \Auth::user()->type == '1')
                        <a href="{{ route('addNewPharmacy') }}" class="btn btn-blue col-1" style="margin: 10px;display: inline-block;float: right;">Add New</a>
                    @endif

                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Number</th>
                            <th>City</th>
                            <th class="w-1 text-center"><i class="fe fe-settings"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $pharms as $pos )
                            <tr>
                                <td class="">
                                    <div>{{ $pos->name }}</div>
                                </td>
                                <td>
                                    <div>{{$pos->email}}</div>
                                </td>
                                <td>
                                    <div>{{$pos->number}}</div>
                                </td>
                                <td>
                                    <div>{{$pos->city}}</div>
                                </td>

                                <td>
                                    <div style="display: inline-block;">
                                        @if(isset(\Auth::user()->type) && \Auth::user()->type == '1')
                                            <a class="btn btn-green" href="{{route('pharmacy.view', $pos->id)}}"> View </a>
                                            <a class="btn btn-blue" href="{{route('editPharmacyProfile', $pos->id)}}">Edit</a>
                                            <a class="btn btn-danger" href="{{route('deletePharmacy', $pos->id)}}">Delete</a>
                                         @endif

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