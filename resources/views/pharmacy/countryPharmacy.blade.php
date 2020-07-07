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
                                    <img class="card-img-top" src="{{storage_path('/app/image/' . $pos->image)}}" onerror="this.src='data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22286%22%20height%3D%22180%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20286%20180%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_17323c1165d%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A14pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_17323c1165d%22%3E%3Crect%20width%3D%22286%22%20height%3D%22180%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2299.4140625%22%20y%3D%2296.24375%22%3EImage%20cap%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E'" alt="Card image cap">
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