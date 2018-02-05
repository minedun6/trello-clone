import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        groups: [],
        newStory: {
            title: '',
            description: '',
            due_date: '',
            group_id: ''
        }
    },

    actions: {
        fetchData(context) {
            axios.get('/stories')
                .then(res => {
                    if (res.data.success) {
                        context.commit('setGroups', res.data.groups);
                    }
                }).catch(err => {
                console.log(err)
            })
        },
        setGroupOrder(context, {group}) {
            context.commit('setGroupOrder', group);

            // context.dispatch('syncStoriesOrder', group)
        }
    },

    mutations: {
        setGroups(state, groups) {
            state.groups = groups
        },
        updateList(state, {group, value}) {
            console.log(group, value)
        },
        setGroup(state, group) {
            state.newStory.group_id = group
        },
        setGroupOrder(state, group) {
            let targetGroup = state.groups.find(g => group.id === g.id);
            if (targetGroup !== null) {
                targetGroup.stories.map((story, index) => {
                    story.rank = index + 1;
                });
            }
        }
    },

    getters: {
        groups(state, getters) {
            return state.groups
        },
        newStory(state, getters) {
            return state.newStory
        }
    }

});