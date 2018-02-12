import Vue from 'vue';
import store from './store';
import FontAwesomeIcon from '@fortawesome/vue-fontawesome'
import fontawesome from '@fortawesome/fontawesome'
import solid from '@fortawesome/fontawesome-free-solid'
import faSpinner from '@fortawesome/fontawesome-free-solid/faSpinner'

fontawesome.library.add(solid, faSpinner);

Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('kanban-board', require('./components/KanbanBoard.vue'));

const app = new Vue({
    el: '#app',
    store
});
