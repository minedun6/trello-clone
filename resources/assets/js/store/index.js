import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
//import {colors} from '/tailwind'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        groups: [],
        newGroup: {
            name: '',
            color_class: ''
        },
        newStory: {
            title: '',
            description: '',
            due_date: '',
            group_id: ''
        },
        loading: false,
    },
    actions: {
        fetchData(context) {
            context.commit('enableLoading', true)

            axios.get('/stories').then(res => {
                if (res.data.success) {
                    setTimeout(() => {
                        context.commit('setGroups', res.data.groups)
                        context.commit('enableLoading', false)
                    }, 0)
                }
            }).catch(err => {
                console.log(err)
                context.commit('enableLoading', false)
            })
        },
        setGroupsOrder(context, payload) {
            context.state.groups.map((group, index) => {
                context.commit('setGroupOrder', {
                    group: group,
                    order: (index + 1)
                })
            })
            context.dispatch('syncGroupsOrder', context.state.groups)
        },
        syncGroupsOrder(context, groups) {
            return new Promise((resolve, reject) => {
                axios.put(`/projects/groups/`, {
                    groups: groups
                }).then(res => {
                    context.commit('setGroups', res.data.groups)
                    resolve(res)
                }).catch(err => {
                    reject(err)
                })
            })
        },
        setGroupOrder(context, {
            group
        }) {
            let targetGroup = context.state.groups.find(g => group.id === g.id);
            if (targetGroup !== null) {
                targetGroup.stories.map((story, index) => {
                    context.commit('setStoryRank', {
                        story: story,
                        rank: (index + 1)
                    })
                })
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
                })
            })
        },
        createNewGroup(context, group) {
            return new Promise((resolve, reject) => {
                axios.post('/groups', {
                    group
                }).then(res => {
                    if (res.data.success) {
                        context.commit('addNewGroup', res.data.group)
                        context.commit('resetGroup');
                    }
                    resolve(res)
                }).catch(err => {
                    reject(err)
                })
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
        setStoryRank(state, {
            story,
            rank
        }) {
            story.rank = rank
        },
        setGroupOrder(state, {
            group,
            order
        }) {
            group.order = order
        },
        addNewGroup(state, group) {
            state.groups.push(group)
        },
        enableLoading(state, isLoading) {
            state.loading = isLoading
        }
    },
    getters: {
        groups(state, getters) {
            return state.groups
        },
        newStory(state, getters) {
            return state.newStory
        },
        newGroup(state, getters) {
            return state.newGroup
        },
        loading(state, getters) {
            return state.loading
        }
    }
});
