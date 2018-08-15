import Vue from 'vue';

import { FontAwesomeIcon, FontAwesomeLayers } from '@fortawesome/vue-fontawesome'
import fontawesome from '@fortawesome/fontawesome';
import regular from '@fortawesome/fontawesome-free-regular';
import solid from '@fortawesome/fontawesome-free-solid';
import faSpinner from '@fortawesome/fontawesome-free-solid/faSpinner';
fontawesome.library.add(regular, solid, faSpinner);
Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('font-awesome-layers', FontAwesomeLayers);

Vue.component('gdrive', require('../PickerButton'))

const app = new Vue({
    el: '#app'
});
