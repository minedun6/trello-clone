import Vue from 'vue';
import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
import fontawesome from '@fortawesome/fontawesome';
import solid from '@fortawesome/fontawesome-free-solid';
import faSpinner from '@fortawesome/fontawesome-free-solid/faSpinner';
import VModal from 'vue-js-modal';

import store from './store';

Vue.use(VModal);

fontawesome.library.add(solid, faSpinner);

Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('navigation', require('./components/Navigation.vue'));
Vue.component('project-menu', require('./components/ProjectMenu.vue'));
Vue.component('kanban-board', require('./components/KanbanBoard.vue'));
Vue.component('uploader', require('./components/Uploader.vue'));
Vue.component('testing-uploader', require('./components/TestingUploader.vue'));
Vue.component('new-group-modal', require('./components/NewGroupModal'));
Vue.component('new-story-modal', require('./components/NewStoryModal'));
Vue.component('member-picker-modal', require('./components/MemberPickerModal'));

Vue.component('tags-input', require('./components/TagsInput.vue'));
Vue.component('inline-tags-input', require('./components/InlineTagsInput.vue'));

const app = new Vue({
    el: '#app',
    store
});
