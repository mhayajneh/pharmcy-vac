@extends('layouts.app')

@section('content')
    <body>
    <body>

    <div class="form-group">
        <label>Type a Pharmacy name</label>
        <input type="text" name="country" id="country" placeholder="Enter country name" class="form-control">
    </div>
    <div id="country_list"></div>
    <div id="app">
        <example-component></example-component>
    </div>
    </body>

    </body>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {

            $('#country').on('keyup',function() {
                var query = $(this).val();
                $.ajax({
                    url:"{{ route('search') }}",
                    type:"GET",
                    data:{'country':query},
                    success:function (data) {
                        $('#country_list').html(data);
                    }
                })
                // end of ajax call
            });


            $(document).on('click', 'li', function(){
                var value = $(this).text();
                var id = $(this).attr("data-id");
                $('#country').val(value + id);
                $('#country_list').html("");
                var url = '/pharmacy/'+id;
                window.location = url;
            });
        });
    </script>

@endsection