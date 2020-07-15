@extends('layouts.app')
@section('content')



    <div class="row-cards row-deck">
        <div class="card">
<div style="padding: 15px;margin: 15px;">
    {!! Form::open(['method' => 'POST', 'route' => ('updateFilterCity')]) !!}

    <div class="form-group" id="city-div">
        <Label for="city" class="form-label"> Select City </Label>
        <select name="city" id="city" class="form-control">
            <option value="">Select City</option>
            <option value="Amman" <?php if($city == 'Amman') {echo 'selected';} ?>>Amman</option>
            <option value="Aqabah" <?php if($city == 'Aqabah') {echo 'selected';} ?>>Aqabah</option>
            <option value="Mafraq" <?php if($city == 'Mafraq') {echo 'selected';} ?>>Mafraq</option>
            <option value="At-Tafilah" <?php if($city == 'At-Tafilah') {echo 'selected';} ?>>At-Tafilah</option>
            <option value="Irbid" <?php if($city == 'Irbid') {echo 'selected';} ?>>Irbid</option>
            <option value="Maan" <?php if($city == 'Maan') {echo 'selected';} ?>>Maan</option>
            <option value="Ajlun" <?php if($city == 'Ajlun') {echo 'selected';} ?>>Ajlun</option>
            <option value="Jarash" <?php if($city == 'Jarash') {echo 'selected';} ?>>Jarash</option>
            <option value="Al-Balqa" <?php if($city == 'Al-Balqa') {echo 'selected';} ?>>Al-Balqa</option>
            <option value="Madaba" <?php if($city == 'Madaba') {echo 'selected';} ?>>Madaba</option>
            <option value="Al-Karak" <?php if($city == 'Al-Karak') {echo 'selected';} ?>>Al-Karak</option>
            <option value="Az-Zarqa" <?php if($city == 'Az-Zarqa') {echo 'selected';} ?>>Az-Zarqa</option>
        </select>
    </div>

    <div class="form-group" id="city-div">
        <Label for="city" class="form-label"> Name </Label>
        <input type="text" name="name" id="name" class="form-control" value="{{$filter}}">
    </div>
    <div class="form-footer">
        <button type="submit" class="btn btn-primary btn-block">Filter</button>
    </div>
    {!! Form::close() !!}

</div>
        </div>

    </div>


    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div>
                    <h3 style="padding: 10px;display: inline-block;"> List of Pharmacies in {{$city}}</h3>


                </div>
                <div class="container">
                    <div class="row">
                    @foreach( $pharmas as $pos )
                        <div class="col-3">
                            <a href="{{route('pharmacy.view', $pos->id)}}">
                                <div class="card" >
                                    <img class="card-img-top" src="{{storage_path($pos->image)}}"  alt="Card image cap">
                                    <div class="card-body">
                                        <p class="card-title">{{ $pos->name }}</p>
                                        <p class="card-text">{{$pos->email}} <br> {{$pos->number}} <br> {{$pos->location}} <br>  {{$pos->city}} <br> {{$pos->manager}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection