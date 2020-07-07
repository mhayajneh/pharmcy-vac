@extends('layouts.app')

@section('content')
    <div class="row-cards row-deck">
        <div class="card">
            <div style="margin: 15px;">
               @if(isset(\Auth::user()->type) && \Auth::user()->type == '3')
                <a href="{{route('editTraineeProfile', $user->id)}}" class="btn btn-blue" style="float: right;">Edit</a>
                @endif

                <div class="row">
                <div class="col-sm-6 col-lg-5" >
                    <b> Name: </b> {{$user->name}}
                </div>

                <div class="col-sm-6 col-lg-5" style="margin-left: 1.5rem;">
                    <b> Email: </b> {{$user->email}}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-6 col-lg-5" style="margin-left: 10px;">
                    <b> Number: </b> {{$user->number}}
                </div>

                <div class="col-sm-6 col-lg-5" style="margin-left: 10px;">
                    <b> Letter: </b> {{$user->letter}}
                </div>

                <div class="col-sm-6 col-lg-5" style="margin-left: 10px;">
                    <b> University: </b> {{$user->university}}
                </div>

                <div class="col-sm-6 col-lg-5" style="margin-left: 10px;">
                    <b> University number: </b> {{$user->university_number}}
                </div>
            </div>
            <br>

            </div>
        </div>

    </div>

    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div>
                <h3 style="padding: 10px;display: inline-block;">Applied Training Positions</h3>

                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                        <tr>
                            <th>Position</th>
                            <th>Pharmacy</th>
                            <th class="w-1">Applied Date</th>
                            <th class="w-1">Status</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $userTrainings as $pos )
                            <tr>
                                <td class="">
                                    <div>{{ $pos->tpTitle }}</div>
                                </td>
                                <td>
                                    <div>{{$pos->name}}</div>
                                </td>
                                <td class="">
                                    <div>{{$pos->created_at}}</div>
                                </td>
                                <td class="">
                                    @if($pos->status == 0)
                                        <label for="" class="btn-blue" style="padding: 2px;">In Process</label>
                                    @elseif($pos->status == 1)
                                        <label for="" class="btn-green"  style="padding: 2px;">Accepted</label>
                                    @elseif($pos->status == 2)
                                        <label for="" class="btn-danger" style="padding: 2px;">Cancelled</label>

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
    <script type="text/javascript">
        $(function(){
            $(':checkbox').each(function() {
                $(this).change(function() {
                    var $form = $(this).closest("form");

                    $form.submit();

                    console.log($form);
                });
            });
        });
    </script>
@endsection