@extends('layouts.auth')

@section('content')
<div class="col col-login mx-auto">
  <div class="text-center mb-6">
    <img src="{{ $logo_url }}" class="h-6" alt="">
  </div>
  {!! Form::open(['method' => 'POST', 'route' => 'register', 'class' => 'card', 'enctype' => 'multipart/form-data']) !!}
    <div class="card-body p-6">
      <div class="card-title">{{ __('Register') }}</div>

        <div class="form-group">
            <Label for="type" class="form-label">Sign up As</Label>
            <select name="type" id="type" class="form-control">
                <option value="2"> Pharmacy </option>
                <option value="3"> Trainee </option>
            </select>
        </div>

      <div class="form-group">
        {!! Form::label('name', __('Name'), ['class' => 'form-label']) !!}
        {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Enter Name']) !!}

        @if ($errors->has('name'))
        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
        @endif
      </div>

      <div class="form-group">
        {!! Form::label('email', __('E-Mail'), ['class' => 'form-label']) !!}
        {!! Form::text('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Enter email']) !!}

        @if ($errors->has('email'))
        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
        @endif
      </div>

        <div class="form-group">
            {!! Form::label('number', __('Number'), ['class' => 'form-label']) !!}
            {!! Form::text('number', null, ['class' => 'form-control' . ($errors->has('number') ? ' is-invalid' : ''), 'placeholder' => 'Enter Number']) !!}

            @if ($errors->has('email'))
                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <div class="form-group" id="location-div">
            <Label for="location" class="form-label"> Address </Label>
            <input type="text" name="location" id="location" class="form-control">

        </div>

        <div class="form-group" id="city-div">
            <Label for="city" class="form-label"> City </Label>
            <select name="city" id="city" class="form-control">
                <option value="">Select City</option>
                <option value="Amman">Amman</option>
                <option value="Aqabah">Aqabah</option>
                <option value="Mafraq">Mafraq</option>
                <option value="At-Tafilah">At-Tafilah</option>
                <option value="Maan">Maan</option>
                <option value="Irbid">Irbid</option>
                <option value="Ajlun">Ajlun</option>
                <option value="Jarash">Jarash</option>
                <option value="Al-Balqa">Al-Balqa</option>
                <option value="Madaba">Madaba</option>
                <option value="Al-Karak">Al-Karak</option>
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

        <div class="form-group" id="university-div">
            <Label for="university" class="form-label"> University </Label>
            <input type="text" name="university" id="university" class="form-control">
        </div>

        <div class="form-group" id="university_number-div">
            <Label for="university_number" class="form-label"> University number </Label>
            <input type="text"  name="university_number" id="university_number" class="form-control">
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
      <div class="form-footer">
        <button type="submit" class="btn btn-primary btn-block">Sign up</button>
      </div>
    </div>
  {!! Form::close() !!}
  <div class="text-center text-muted">
    Already have account? <a href="{{ route('login') }}">Log in</a>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<script type="text/javascript">

    $(function () {
        $('#location-div, #area-div, #city-div, #image-div, #manager-div, #students-div').show();
        $('#letter-div, #university-div, #university_number-div').hide();
        $("#type").change(function(){
            $('#location-div, #area-div, #city-div, #image-div, #manager-div, #students-div').show();
            $('#letter-div, #university-div, #university_number-div').hide();
            var type = $("select#type option:selected").attr('value');
            if (type === '3') {
                $('#location-div, #area-div, #city-div, #image-div, #manager-div, #students-div').hide();
                $('#letter-div, #university-div, #university_number-div').show();
            }

        });
    });

</script>


@endsection

