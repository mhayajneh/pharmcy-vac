@extends('layouts.app')

@section('content')

    <div class="row row-cards row-deck">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['method' => 'PUT', 'route' => ['trainingPositions.update', $pos]]) !!}
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                {!! Form::label('title', 'Title', ['class' => 'form-label']) !!}
                                <input type="text" name="title" value="{{$pos->title}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Due Date', ['class' => 'form-label']) !!}
                        <input type="date" name="last_apply_date"class="form-control" value="{{$pos->last_apply_date}}">

                    </div>

                    <div class="form-group">
                        {!! Form::label('is_visible', 'Is Visible', ['class' => 'form-label']) !!}
                        <select name="is_visible" id="" class="form-control">
                            <option value="1">yes</option>
                            <option value="0">no</option>
                        </select>
                    </div>

                    <input type="hidden" name="pharmacy_id" value="{{$pos->pharmacy_id}}">
                    <input type="hidden" name="is_visible" value="1">

                    <div class="row align-items-center">
                        <div class="col-auto">
                            <span class="avatar avatar-md avatar">{{ auth()->user()->initials }}</span>
                        </div>
                        <div class="col">
                            <div>{{ auth()->user()->name }}</div>
                            <small class="d-block item-except text-sm text-muted h-1x">{{ auth()->user()->email }}</small>
                        </div>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection