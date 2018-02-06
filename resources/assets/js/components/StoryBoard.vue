<template>
    <div class="column" style="width: 400px;">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase">
                        {{ group.name }}
                    </span>
                    <span class="badge badge-default text-black">
                        {{ group.stories_count }}
                    </span>
                </div>
            </div>
            <!-- end PROJECT HEAD -->
            <div class="portlet-body board-container">
                <div class="todo-tasklist">
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
        methods: {
            syncStoriesOrder(group) {
                this.$store.dispatch('setGroupOrder', {group});
            }
        },
    };
</script>

<style>
    .no-resize {
        resize: none;
    }

    .column {
        margin-right: 20px;
    }

    .board-container {
        height: 500px;
        overflow-x: auto;
    }
</style>
