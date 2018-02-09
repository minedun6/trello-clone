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
            </div>
        </div>
        <div class="portlet-body drag-container">
            <div class="todo-content">
                <vue-draggable class="draggable-area"
                               :list="groups"
                               :options="groupsDraggableOptions"
                               @change="syncGroupsOrder">
                    <story-board v-for="group in groups" :group="group" :key="group.id"/>
                </vue-draggable>
                <new-story-board/>
            </div>
        </div>
        <story-modal/>
    </div>
</template>

<script>
    import vSelect from 'vue-select'
    import VueDraggable from 'vuedraggable'
    import storyBoard from './StoryBoard'
    import NewStoryBoard from './NewStoryBoard'
    import StoryModal from './StoryModal'
    import {groupsDraggableOptions} from "./config";

    export default {
        components: {
            storyBoard, vSelect, VueDraggable, NewStoryBoard, StoryModal
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

    .draggable-area {
        display: flex;
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