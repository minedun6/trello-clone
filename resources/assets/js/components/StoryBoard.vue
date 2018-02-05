<template>
    <div class="column sortable" style="width: 400px;">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase">
                        {{ group.name }}
                    </span>
                    <span class="badge badge-default text-black">
                        {{ groupStoriesCount }}
                    </span>
                </div>
            </div>
            <!-- end PROJECT HEAD -->
            <vue-scrollbar class="portlet-body" style="height: 500px;">
                <div class="todo-tasklist">
                    <vue-draggable style="min-height: 499px;"
                                   :list="group.stories"
                                   :options="draggableOptions"
                                   @add="syncOrderAddedToGroup(group)"
                                   @end="syncOrderRemovedFromGroup(group)"
                    >
                        <story-card v-for="story in group.stories" :story="story" :group="group" :key="story.id"/>
                    </vue-draggable>
                </div>
                <div class="todo-tasklist-devider"></div>
            </vue-scrollbar>
        </div>
    </div>
</template>

<script>
    import VueDraggable from "vuedraggable";
    import VueScrollbar from "vue2-scrollbar";
    import StoryCard from "./StoryCard";
    import {draggableOptions} from "./config";

    export default {
        props: ["group"],
        components: {
            VueDraggable,
            VueScrollbar,
            StoryCard
        },
        data() {
            return {
                draggableOptions,
            };
        },
        computed: {
            groupStoriesCount() {
                return this.group.stories.length;
            }
        },
        methods: {
            syncOrderAddedToGroup(group) {
                this.$store.dispatch('setGroupOrder', {group});

                return new Promise((resolve, reject) => {
                    axios.put(`/groups/${group.id}/stories`, {
                        stories: group.stories
                    }).then(res => {
                        resolve(res)
                    }).catch(err => {
                        reject(err)
                    });
                })
            },
            syncOrderRemovedFromGroup(group) {
                this.$store.dispatch('setGroupOrder', {group})

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
    };
</script>

<style>
    .no-resize {
        resize: none;
    }

    .column {
        margin-right: 20px;
    }
</style>
