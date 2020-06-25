@extends('layouts.app')

@section('content')
    <div class="row-cards row-deck">
        <div class="card">
            <div style="margin: 15px;">

                <div class="row" style="padding: 10px;">
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

                    @if($user->cv_path)
                        <div class="col-sm-6 col-lg-5">
                            <a href="{{ route('downloadTraineeCv', $user->id) }}" class="btn btn-danger">Download CV</a>
                        </div>
                    @endif

                </div>
                <br>
            </div>
        </div>

    </div>


@endsection

@section('scripts')
