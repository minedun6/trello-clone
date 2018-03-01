import Vue from 'vue';
import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
import fontawesome from '@fortawesome/fontawesome';
import regular from '@fortawesome/fontawesome-free-regular';
import solid from '@fortawesome/fontawesome-free-solid';
import faSpinner from '@fortawesome/fontawesome-free-solid/faSpinner';
import VModal from 'vue-js-modal';

import store from './store';

Vue.use(VModal);

fontawesome.library.add(regular, solid, faSpinner);

Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('navigation', require('./components/Navigation'));
Vue.component('project-menu', require('./components/ProjectMenu'));
Vue.component('kanban-board', require('./components/KanbanBoard'));
Vue.component('uploader', require('./components/Uploader'));
Vue.component('testing-uploader', require('./components/TestingUploader'));
Vue.component('new-group-modal', require('./components/NewGroupModal'));
Vue.component('new-story-modal', require('./components/NewStoryModal'));
Vue.component('member-picker-modal', require('./components/MemberPickerModal'));
Vue.component('login', require('./components/Login'));

Vue.component('tags-input', require('./components/TagsInput'));
Vue.component('inline-tags-input', require('./components/InlineTagsInput'));

Vue.prototype.$eventHub = new Vue();

const app = new Vue({
    el: '#app',
    store
});
