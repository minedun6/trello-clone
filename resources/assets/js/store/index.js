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
            let targetGroup = context.state.groups.find(g => group.id === g.id);

            if (targetGroup !== null) {
                targetGroup.stories.map((story, index) => {
                    context.commit('setStoryRank', {
                        story: story,
                        rank: (index + 1)
                    });
                });
            }

            context.dispatch('syncStoriesOrder', group)
        },
        syncStoriesOrder(context, group) {
            return new Promise((resolve, reject) => {
                axios.put(`/groups/${group.id}/stories`, {
                    stories: group.stories
                }).then(res => {
                    resolve(res)
                }).catch(err => {
                    reject(err)
                });
            })
        }
    },

    mutations: {
        setGroups(state, groups) {
            state.groups = groups
        },
        setGroup(state, group) {
            state.newStory.group_id = group
        },
        setStoryRank(state, {story, rank}) {
            story.rank = rank
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