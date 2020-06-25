<template>
    <div id="app">
        <l-map :center="[30.5852, 36.2384]" :zoom="7" style="height: 500px;" :options="mapOptions">
            <l-choropleth-layer :data="items" titleKey="department_name" idKey="department_id" :value="value" geojsonIdKey="dpto" :geojson="paraguayGeojson" :colorScale="colorScale">
                <template slot-scope="props">
                    <l-info-control :item="props.currentItem" :unit="props.unit" title="Jordan Cities" placeholder="Hover over a city"/>
                    <l-reference-chart title="Pharmacies in Jordan" :colorScale="colorScale" :min="props.min" :max="props.max" position="topright"/>
                </template>
            </l-choropleth-layer>
        </l-map>
    </div>
</template>

<script>
    import { InfoControl, ReferenceChart, ChoroplethLayer } from 'vue-choropleth'

    import { geojson } from './data/py-departments-geojson'
    import paraguayGeojson from './data/paraguay.json'
    //import { pyDepartmentsData } from './data/py-departments-data'
    import {LMap, LPopup} from 'vue2-leaflet';

    export default {
        name: "app",
        components: {
            LMap,
            'l-info-control': InfoControl,
            'l-reference-chart': ReferenceChart,
            'l-choropleth-layer': ChoroplethLayer
        },
        data() {
            return {
                items: [],
                paraguayGeojson,
                colorScale: ["e7d090", "e9ae7b", "de7062"],
                value: {
                    key: "amount_w",
                    metric: ": pharmacies"
                },
                mapOptions: {
                    style: function style(feature) {
                        return {
                            weight: 4,
                            opacity: 0.7,
                            color: '#666',
                            fillOpacity: 0.3
                        };
                    },
                    onEachFeature: onEachFeature.bind(this),
                }
            }
                },
        mounted() {

            axios.get('/getPharmacyCount', {
            })
                .then(response => {
                    this.items = response.data
                    console.log(response.data);
                })
        },
    }
    function onEachFeature(feature, layer) {
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
            click: zoomToFeature
        });
    }
    function zoomToFeature(e) {
        console.log(e.target.feature.properties.name);
        map.fitBounds(e.target.getBounds());
    }
</script>
<style>
    body {
        background-color: #e7d090;
        margin-left: 100px;
        margin-right: 100px;
    }

    #map {
        background-color: #eee;
    }
</style>
