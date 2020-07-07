@extends('layouts.app')

@section('content')

    <div class="row row-cards row-deck">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['method' => 'POST', 'enctype' => 'multipart/form-data', 'route' => ['updatePharmacyProfile', $user->id]]) !!}
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
                    <div class="form-group" id="location-div">
                        <Label for="location" class="form-label"> Address </Label>
                        <input type="text" name="location" id="location" class="form-control" value="{{$user->location}}">

                    </div>
                    <div class="form-group" id="area-div">
                        <Label for="area" class="form-label"> Area </Label>
                        <input type="text" name="area" id="area" class="form-control" value="{{$user->area}}">
                    </div>

                    <div class="form-group" id="city-div">
                        <Label for="city" class="form-label"> City </Label>
                        <select name="city" id="city" class="form-control">
                            <option value="">Select City</option>
                            <option value="Amman" <?php if($user->city == 'Amman') {echo 'selected';} ?>>Amman</option>
                            <option value="Aqabah" <?php if($user->city == 'Aqabah') {echo 'selected';} ?>>Aqabah</option>
                            <option value="Mafraq" <?php if($user->city == 'Mafraq') {echo 'selected';} ?>>Mafraq</option>
                            <option value="At-Tafilah" <?php if($user->city == 'At-Tafilah') {echo 'selected';} ?>>At-Tafilah</option>
                            <option value="Irbid" <?php if($user->city == 'Irbid') {echo 'selected';} ?>>Irbid</option>
                            <option value="Maan" <?php if($user->city == 'Maan') {echo 'selected';} ?>>Maan</option>
                            <option value="Ajlun" <?php if($user->city == 'Ajlun') {echo 'selected';} ?>>Ajlun</option>
                            <option value="Jarash" <?php if($user->city == 'Jarash') {echo 'selected';} ?>>Jarash</option>
                            <option value="Al-Balqa" <?php if($user->city == 'Al-Balqa') {echo 'selected';} ?>>Al-Balqa</option>
                            <option value="Madaba" <?php if($user->city == 'Madaba') {echo 'selected';} ?>>Madaba</option>
                            <option value="Al-Karak" <?php if($user->city == 'Al-Karak') {echo 'selected';} ?>>Al-Karak</option>
                            <option value="Az-Zarqa" <?php if($user->city == 'Az-Zarqa') {echo 'selected';} ?>>Az-Zarqa</option>
                        </select>
                    </div>
                    <div class="form-group" id="manager-div">
                        <Label for="manager" class="form-label"> Manager </Label>
                        <input type="text" name="manager" id="manager" value="{{$user->manager}}" class="form-control">
                    </div>

                    <div class="form-group" id="students-div">
                        <Label for="students" class="form-label"> Number of students </Label>
                        <input type="number" min="2" max="5" name="students" value="{{$user->students}}"  id="students" class="form-control">
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