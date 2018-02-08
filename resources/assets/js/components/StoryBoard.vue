<template>
    <div class="column">
        <div class="portlet light bordered column-container">
            <div class="portlet-title group-handle">
                <div class="caption">
                    <span class="caption-subject bold uppercase">
                        {{ group.name }}
                    </span>
                    <span class="badge badge-default">
                        {{ storiesCount }}
                    </span>
                </div>
            </div>
            <!-- end PROJECT HEAD -->
            <div class="portlet-body">
                <div class="todo-tasklist board-container">
                    <vue-draggable style="min-height: 499px;"
                                   :list="group.stories"
                                   :options="storyDraggableOptions"
                                   @change="syncStoriesOrder(group)"
                    >
                            <story-card v-for="story in group.stories" :story="story" :group="group" :key="story.id"/>
                    </vue-draggable>
                </div>
                <div class="todo-tasklist-devider"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import VueDraggable from "vuedraggable";
    import StoryCard from "./StoryCard";
    import {storyDraggableOptions} from "./config";

    export default {
        props: ["group"],
        components: {
            VueDraggable,
            StoryCard
        },
        data() {
            return {
                storyDraggableOptions,
            };
        },
        computed: {
           storiesCount() {
               return this.group.stories.length
           }
        },
        methods: {
            syncStoriesOrder(group) {
                this.$store.dispatch('setGroupOrder', {group});
            }
        },
    };
</script>

<style>
    .group-handle {
        cursor: move;
    }

    .no-resize {
        resize: none;
    }

    .column {
        height: 100%;
        width: 400px;
        margin-right: 20px;
    }

    .column-container {
        border-radius: 5px !important;
    }

    .board-container {
        height: 500px;
        overflow-x: auto;
    }
</style>
