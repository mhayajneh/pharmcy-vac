@extends('layouts.app')

@section('content')

    <div class="row row-cards row-deck">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['method' => 'POST', 'enctype' => 'multipart/form-data', 'route' => ['traineeProfile.update', $user->id]]) !!}
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                {!! Form::label('name', __('Name'), ['class' => 'form-label']) !!}
                                {!! Form::text('name', $user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', __('E-Mail'), ['class' => 'form-label']) !!}
                        {!! Form::text('email', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : '')]) !!}

                   </div>
                    <div class="form-group">
                        {!! Form::label('number', __('Number'), ['class' => 'form-label']) !!}
                        {!! Form::text('number', $user->number, ['class' => 'form-control' . ($errors->has('number') ? ' is-invalid' : '')]) !!}
                    </div>

                    <div class="form-group" id="cv-div">
                        <Label for="usercv" class="form-label"> CV: </Label>
                        <input type="file" name="usercv" id="usercv" class="form-control">
                    </div>

                    <div class="form-group">
                        {!! Form::label('password', __('Password'), ['class' => 'form-label']) !!}
                        {!! Form::password('password', ['class' => 'form-control' . ($errors->has('password ') ? ' is-invalid' : ''), 'placeholder' => 'Password']) !!}

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        {!! Form::label('password_confirmation', __('Confirm Password'), ['class' => 'form-label']) !!}
                        {!! Form::password('password_confirmation', ['class' => 'form-control' . ($errors->has('password_confirmation ') ? ' is-invalid' : ''), 'placeholder' => 'Password Confirmation']) !!}

                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
                        @endif
                    </div>




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