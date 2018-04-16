import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import { colors } from './../../../../tailwind'
import { randomObjectKey } from './../util'

import {defaultGroup, defaultStory} from "./defaults";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        groups: [],
        members: [],
        newGroup: {...defaultGroup},
        newStory: {...defaultStory},
        loading: false,
    },
    actions: {
        enableLoading(context, flag) {
            context.commit('enableLoading', flag)
        },
        fetchData(context) {
            context.dispatch('enableLoading', true)

            axios.get('/api/data').then(res => {
                if (res.data.success) {
                    context.commit('setGroups', res.data.groups)
                    context.commit('setMembers', res.data.members)
                    context.dispatch('enableLoading', false)
                }
            }).catch(err => {
                console.log(err)
                context.dispatch('enableLoading', false)
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
            context.dispatch('enableLoading', true)
            return new Promise((resolve, reject) => {
                axios.put(`/projects/groups/`, {
                    groups: groups
                }).then(res => {
                    context.commit('setGroups', res.data.groups)
                    context.dispatch('enableLoading', true)
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
            context.dispatch('enableLoading', true)

            return new Promise((resolve, reject) => {
                axios.put(`/groups/${group.id}/stories`, {
                    stories: group.stories
                }).then(res => {
                    context.dispatch('enableLoading', false)
                    resolve(res)
                }).catch(err => {
                    reject(err)
                })
            })
        },
        createNewGroup(context, group) {
            group.color_class = colors[randomObjectKey(colors)]
            context.dispatch('enableLoading', true)

            return new Promise((resolve, reject) => {
                axios.post('/groups', {
                    group
                }).then(res => {
                    if (res.data.success) {
                        context.commit('addNewGroup', res.data.group);
                        resolve(res)
                    }
                }).catch(err => {
                    reject(err)
                })
            })
        },
        createNewStory(context, {group, story}) {
            context.dispatch('enableLoading', true)

            return new Promise((resolve, reject) => {
                axios.post('/stories', {story})
                    .then(res => {
                        if (res.data.success) {
                            context.commit('addNewStory', {
                                story: res.data.story
                            });
                            resolve(res)
                        }
                    }).catch(err => {
                        reject(err)
                })
                                                                                                               })
        }
    },
    mutations: {
        setMembers(state, members) {
            state.members = members;
        },
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
        addNewStory(state, {story}) {
            let group = state.groups.find(g=> g.id === story.group_id)
            group.stories.push(story)
        },
        enableLoading(state, isLoading) {
            state.loading = isLoading
        }
    },
    getters: {
        members(state, getters) {
            return state.members;
        },
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
