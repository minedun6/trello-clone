<template>
    <div class="portlet bordered light">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject bold">
                    <i class="fa fa-briefcase"></i>
                    Project #1
                </span>
            </div>
            <div class="actions">
                <div class="btn-group">
                    <b-btn v-b-modal.storyModal class="btn default btn-sm">
                        <i class="fa fa-plus"></i>
                        New Story
                    </b-btn>
                </div>
            </div>
        </div>
        <div class="portlet-body drag-container">
            <vue-draggable :list="groups" :options="groupsDraggableOptions" class="todo-content" @change="syncGroupsOrder">
                <story-board v-for="group in groups" :group="group" :key="group.id"/>
            </vue-draggable>
        </div>
        <b-modal id="storyModal"
                 ref="storyModal"
                 title="Add new Story"
                 class="font-bold"
                 title-tag="h4">
            <form @submit.stop.prevent="handleSubmit">
                <div class="form-group">
                    <label for="story-title" class="label-control">Title</label>
                    <input type="text" class="form-control" id="story-title" v-model="newStory.title">
                </div>
                <div class="form-group">
                    <label for="story-description" class="label-control">Description</label>
                    <textarea id="story-description" cols="10" rows="5"
                              class="form-control no-resize" v-model="newStory.description">
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="story-due-date" class="label-control">Due Date</label>
                    <input type="date" id="story-due-date" class="form-control" v-model="newStory.due_date">
                </div>
                <div class="form-group">
                    <label for="story-due-date" class="label-control">Group</label>
                    <v-select label="name"
                              :options="$store.state.groups"
                              :value="$store.state.newStory.group_id"
                              @input="setGroup">
                    </v-select>
                </div>
            </form>
            <div slot="modal-footer">
                <b-btn size="sm" class="float-right" variant="primary" @click="show=false">
                    Close
                </b-btn>
                <b-btn size="sm" class="float-right" variant="default" @click="show=false">
                    Save story
                </b-btn>
            </div>
        </b-modal>
    </div>
</template>

<script>
    import vSelect from 'vue-select'
    import VueDraggable from 'vuedraggable'
    import storyBoard from './StoryBoard'
    import {groupsDraggableOptions} from "./config";

    export default {
        components: {
            storyBoard, vSelect, VueDraggable
        },
        data() {
            return {
                groupsDraggableOptions,
            };
        },
        created() {
            this.$store.dispatch('fetchData')
        },
        computed: {
            groups() {
                return this.$store.getters.groups
            },
            newStory() {
                return this.$store.getters.newStory
            }
        },
        methods: {
            uid() {
                return '_' + Math.random().toString(36).substr(2, 9)
            },
            setGroup(value) {
                this.$store.commit('setGroup', value)
            },
            syncGroupsOrder(event) {
                this.$store.dispatch('setGroupsOrder');
            }
        }
    }
</script>

<style>
    .todo-content {
        display: inline-flex;
        justify-content: space-between;
    }

    .drag-container {
        overflow-y: auto;
    }

    /* Custom styles for scrollbar */
    ::-webkit-scrollbar-track {
        -webkit-border-radius: 10px;
        border-radius: 10px;
    }
    ::-webkit-scrollbar {
        -webkit-appearance: none;
        width: 6px;
        height: 6px;
    }
    ::-webkit-scrollbar-thumb {
        border-radius: 4px;
        background-color: darkgrey;
        -webkit-box-shadow: 0 0 1px rgba(255, 255, 255, .5);
    }
</style>