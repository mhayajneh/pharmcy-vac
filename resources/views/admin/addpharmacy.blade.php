@extends('layouts.app')

@section('content')

    <div class="row row-cards row-deck">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['method' => 'POST', 'enctype' => 'multipart/form-data', 'route' => ('addAdminPharmacy')]) !!}
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                {!! Form::label('name', __('Name'), ['class' => 'form-label']) !!}
                                {!! Form::text('name', '', ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : '')]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', __('E-Mail'), ['class' => 'form-label']) !!}
                        {!! Form::text('email', '', ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : '')]) !!}

                    </div>
                    <div class="form-group">
                        {!! Form::label('number', __('Number'), ['class' => 'form-label']) !!}
                        {!! Form::text('number', '', ['class' => 'form-control' . ($errors->has('number') ? ' is-invalid' : '')]) !!}
                    </div>
                    <div class="form-group" id="location-div">
                        <Label for="location" class="form-label"> Address </Label>
                        <input type="text" name="location" id="location" class="form-control" value="">

                    </div>
                    <div class="form-group" id="area-div">
                        <Label for="area" class="form-label"> Area </Label>
                        <input type="text" name="area" id="area" class="form-control" value="">
                    </div>

                    <div class="form-group" id="city-div">
                        <Label for="city" class="form-label"> City </Label>
                        <select name="city" id="city" class="form-control">
                            <option value="">Select City</option>
                            <option value="Amman" >Amman</option>
                            <option value="Aqabah" >Aqabah</option>
                            <option value="Mafraq" >Mafraq</option>
                            <option value="At-Tafilah">At-Tafilah</option>
                            <option value="Irbid" >Irbid</option>
                            <option value="Maan">Maan</option>
                            <option value="Ajlun" >Ajlun</option>
                            <option value="Jarash" >Jarash</option>
                            <option value="Al-Balqa" >Al-Balqa</option>
                            <option value="Madaba" >Madaba</option>
                            <option value="Al-Karak" >Al-Karak</option>
                            <option value="Az-Zarqa">Az-Zarqa</option>
                        </select>
                    </div>

                    <div class="form-group" id="manager-div">
                        <Label for="manager" class="form-label"> Manager </Label>
                        <input type="text" name="manager" id="manager" class="form-control">
                    </div>

                    <div class="form-group" id="image-div" style="display:none;">
                        <Label for="image" class="form-label"> Image: </Label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="form-group" id="students-div">
                        <Label for="students" class="form-label"> Number of students </Label>
                        <input type="number" min="2" max="5" name="students" id="students" class="form-control">
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
                        <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection