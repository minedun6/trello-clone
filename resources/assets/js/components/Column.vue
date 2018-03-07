<template>
    <div class="column">
        <div class="flex justify-between pt-3 px-4">
            <h3 class="text-sm text-grey-darker">
                <div class="flex">
                    <div class="flex rounded-full bg-grey-darker text-white uppercase px-2 py-1 text-xs mr-3">
                        {{ group.stories.length}}
                    </div>
                    {{ group.name }}
                </div>
            </h3>
            <div class="flex">
                <svg class="h-4 fill-current text-grey-dark cursor-pointer" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 24 24">
                    <path d="M5 10a1.999 1.999 0 1 0 0 4 1.999 1.999 0 1 0 0-4zm7 0a1.999 1.999 0 1 0 0 4 1.999 1.999 0 1 0 0-4zm7 0a1.999 1.999 0 1 0 0 4 1.999 1.999 0 1 0 0-4z"></path>
                </svg>
            </div>
        </div>
        <div class="card-list">
            <div v-dragula="group.stories"
                 drake="quiz"
                 class="h-full">
                <story v-for="story in group.stories" :key="story.id" :story="story" :group="group"/>
            </div>
        </div>
        <new-story :group="group"/>
    </div>
</template>

<script>
    import Story from './Story'
    import NewStory from './NewStory'
    import VueDraggable from 'vuedraggable'
    import {draggableOptions} from './config'

    export default {
        props: ['group'],
        components: {
            Story, VueDraggable, NewStory
        },
        data() {
            return {
                draggableOptions
            }
        },
        methods: {
            syncStoriesOrder(group) {
                this.$store.dispatch('setGroupOrder', {group})
            }
        }
    }
</script>

<style>
    .sortable-ghost, .sortable-chosen {
        cursor: grabbing;
    }
</style>
