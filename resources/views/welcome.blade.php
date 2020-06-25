@extends('layouts.app')
<style>
    body {
        background-color: #ffffff;
    }
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>


<style>
    html, body {
        height: 100%;
        margin: 0;
    }
    #map {
        width: 600px;
        height: 400px;
    }
    .leaflet-control-attribution {
        display: none;
    }
</style>

<style>#map { width: 800px; height: 500px; }
    .info { padding: 6px 8px; font: 14px/16px Arial, Helvetica, sans-serif; background: white; background: rgba(255,255,255,0.8); box-shadow: 0 0 15px rgba(0,0,0,0.2); border-radius: 5px; } .info h4 { margin: 0 0 5px; color: #777; }
    .legend { text-align: left; line-height: 18px; color: #555; } .legend i { width: 18px; height: 18px; float: left; margin-right: 8px; opacity: 0.7; }</style>
@section('content')
    <div class="form-group">
        <label>Type a Pharmacy name</label>
        <input type="text" name="country" id="country" placeholder="Enter country name" class="form-control">
    </div>
    <div id="country_list"></div>


    <div id='map' style="width: 100%;"></div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type="text/javascript" src="jordan-city.js"></script>

    <script type="text/javascript">

        var cities = ['Amman','Aqabah','Mafraq','At-Tafilah','Maan','Irbid','Ajlun','Jarash','Al-Balqa','Madaba','Al-Karak','Az-Zarqa'];
        var pharmas;

        $.ajax({
            url:"{{ route('getPharmacaCount') }}",
            type:"GET",
            success:function (data) {
                pharmas = data;
                $.each( statesData.features, function( key, value ) {

                    value.properties.pharma = pharmas[key].density;

                });
            }
        });


        var map = L.map('map').setView([31.40, 36.2384], 7);

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            id: 'mapbox/light-v9',
            tileSize: 512,
            zoomOffset: -1
        }).addTo(map);


        // control that shows state info on hover
        var info = L.control();

        info.onAdd = function (map) {
            this._div = L.DomUtil.create('div', 'info');
            this.update();
            return this._div;
        };

        info.update = function (props) {
            this._div.innerHTML = '<h4>Pharmacies in Jordan</h4>' +  (props ?
                '<b>' + props.name + '</b><br />' + props.pharma + ' pharmacies'
                : 'Hover over a city');
        };

        info.addTo(map);


        // get color depending on population density value
        function getColor(d) {
            return d > 1000 ? '#800026' :
                d > 500  ? '#BD0026' :
                    d > 200  ? '#E31A1C' :
                        d > 100  ? '#FC4E2A' :
                            d > 50   ? '#FD8D3C' :
                                d > 20   ? '#FEB24C' :
                                    d > 10   ? '#FED976' :
                                        '#FFEDA0';
        }

        function style(feature) {
            return {
                weight: 2,
                opacity: 1,
                color: 'white',
                dashArray: '3',
                fillOpacity: 0.7,
                fillColor: getColor(feature.properties.density)
            };
        }

        function highlightFeature(e) {
            var layer = e.target;

            layer.setStyle({
                weight: 5,
                color: '#666',
                dashArray: '',
                fillOpacity: 0.3
            });


            if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
                layer.bringToFront();
            }

            info.update(layer.feature.properties);
        }

        var geojson;

        function resetHighlight(e) {
            geojson.resetStyle(e.target);
            info.update();
        }

        function zoomToFeature(e) {
            //console.log(e.target.feature.properties.name);
            //map.fitBounds(e.target.getBounds());
            var url = '/getCountryPharma/'+e.target.feature.properties.name;
            window.location = url;
        }

        function onEachFeature(feature, layer) {
            layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
                click: zoomToFeature
            });
        }

        geojson = L.geoJson(statesData, {
            style: style,
            onEachFeature: onEachFeature
        }).addTo(map);


        map.attributionControl.addAttribution('');


        var legend = L.control({position: 'bottomright'});

        legend.onAdd = function (map) {

            var div = L.DomUtil.create('div', 'info legend'),
                grades = [0, 10, 20, 50, 100, 200, 500, 1000],
                labels = [],
                from, to;

            for (var i = 0; i < grades.length; i++) {
                from = grades[i];
                to = grades[i + 1];

                labels.push(
                    '<i style="background:' + getColor(from + 1) + '"></i> ' +
                    from + (to ? '&ndash;' + to : '+'));
            }

            div.innerHTML = labels.join('<br>');
            return div;
        };

        legend.addTo(map);

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