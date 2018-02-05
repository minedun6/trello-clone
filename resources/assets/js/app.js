require('./bootstrap');

window.Vue = require('vue');

import BootstrapVue from 'bootstrap-vue';
import store from './store'

Vue.use(BootstrapVue);

Vue.component('todo-app', require('./components/TodoApp.vue'));

Vue.prototype.$eventHub = new Vue();

const app = new Vue({
    el: '#app',
    store
});
