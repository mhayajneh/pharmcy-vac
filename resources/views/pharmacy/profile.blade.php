@extends('layouts.app')

@section('content')
    <div class="row-cards row-deck">
        <div class="card">
            <div style="margin: 15px;">
               @if(isset(\Auth::user()->type) && \Auth::user()->type == '2')
                <a href="{{route('editPharmacyProfile', \Auth::user()->id)}}" class="btn btn-blue" style="float: right;">Edit</a>
                @endif

                <div class="row">
                <div class="col-sm-6 col-lg-5" >
                    <b> Name: </b> {{$pharmacyData->name}}
                </div>

                <div class="col-sm-6 col-lg-5" style="margin-left: 1.5rem;">
                    <b> Email: </b> {{$pharmacyData->email}}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-6 col-lg-5" style="margin-left: 10px;">
                    <b> Number: </b> {{$pharmacyData->number}}
                </div>

                <div class="col-sm-6 col-lg-5">
                    <b> Address: </b> {{$pharmacyData->location}}
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-sm-6 col-lg-5" style="margin-left: 10px;">
                    <b> Area: </b> {{$pharmacyData->area}}
                </div>

                <div class="col-sm-6 col-lg-5">
                    <b> City: </b> {{$pharmacyData->city}}
                </div>
            </div>
            </div>
        </div>

    </div>

    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div>
                <h3 style="padding: 10px;display: inline-block;">Training Positions</h3>
                @if(isset(\Auth::user()->type) && \Auth::user()->type == '2')
                    <a href="{{ route('addPharmacyTraining', $pharmacyData->id) }}" class="btn btn-blue col-1" style="margin: 10px;display: inline-block;float: right;">Add New</a>
                @endif
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Due Date</th>
                            <th>Created At</th>
                            <th class="w-1 text-center"><i class="fe fe-settings"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $trainingPos as $pos )
                            <tr>
                                <td class="">
                                    <div>{{ $pos->title }}</div>
                                </td>
                                <td>
                                    <div>{{$pos->last_apply_date}}</div>
                                </td>
                                <td class="">
                                    <div>{{$pos->created_at}}</div>
                                </td>

                                <td>
                                    @if(isset(\Auth::user()->type) && \Auth::user()->type == '2')
                                        <div class="item-action dropdown">
                                            <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                                            <div class="dropdown-menu">
                                                <a href="{{ route('viewTrainees', $pos->id) }}" class="dropdown-item"><i class="dropdown-icon fe fe-delete"></i> View</a>
                                                <a href="{{ route('viewTrainees', $pos->id) }}" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Edit</a>
                                                <a href="{{ route('states.show', $pos->id) }}" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Delete</a>
                                            </div>
                                        </div>
                                    @elseif(isset(\Auth::user()->type) && \Auth::user()->type == '3')
                                        <a href="{{route('applyTraining',[\Auth::user()->id, $pos->id])}}" class="btn btn-azure">Apply</a>
                                    @endif
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

@endsection