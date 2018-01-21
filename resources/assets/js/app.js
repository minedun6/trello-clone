
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.component('todo-app', require('./components/TodoApp.vue'));

import Sortable from 'sortablejs'

Vue.directive('sortable', {
    inserted: function (el, binding, vnode) {
        let sortable = new Sortable(el, binding.value || {});

        if (binding.arg) {
            if (!vnode.context.sortable) {
                vnode.context.sortable = {}
            }

            //  Throw an error if the given ID is not unique
            if (vnode.context.sortable[binding.arg]) {
                console.warn('[vue-sortable] cannot set already defined sortable id: \'' + binding.arg + '\'')
            } else {
                vnode.context.sortable[binding.arg] = sortable
            }
        }
    }
})

Vue.prototype.$eventHub = new Vue()

const app = new Vue({
    el: '#app'
});
