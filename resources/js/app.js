require('./bootstrap');

import Datamap from 'datamaps';


window.Vue = require('vue');
Vue.component('example-component', require('./components/Welcome.vue').default);


import 'leaflet/dist/leaflet.css';

const app = new Vue({
    el: '#app'
});