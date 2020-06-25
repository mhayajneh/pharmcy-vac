@extends('layouts.app')

@section('content')
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div>
                    <h3 style="padding: 10px;display: inline-block;">Applied Users</h3>

                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Applied Date</th>
                            <th>Status</th>
                            <th class="w-1 text-center"><i class="fe fe-settings"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $trainees as $pos )
                            <tr>
                                <td class="">
                                    <div>{{ $pos->name }}</div>
                                </td>
                                <td>
                                    <div>{{$pos->created_at}}</div>
                                </td>
                                <td class="">

                                   @if($pos->status == 0)
                                        <div>Review</div>
                                       @elseif($pos->status == 1)
                                        <div>Accepted</div>
                                       @elseif($pos->status ==2)
                                        <div>Cancelled</div>
                                       @endif
                                </td>

                                <td>
                                    <div style="display: inline-block;">
                                        <a class="btn btn-green" href="{{route('viewTrainee', $pos->user_id)}}"> Review </a>
                                    @if($pos->status == 0)
                                            <a class="btn btn-blue" href="{{route('updateTraineesStatus', [$pos->id, 1])}}">Accecpt</a>
                                            <a class="btn btn-danger" href="{{route('updateTraineesStatus', [$pos->id, 2])}}">Cancel</a>
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
