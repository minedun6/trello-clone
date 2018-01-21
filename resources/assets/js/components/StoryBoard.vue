<template>
    <div class="col-md-4 column sortable">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bar-chart font-green-sharp hide"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">{{ group.name }}</span>
                </div>
            </div>
            <!-- end PROJECT HEAD -->
            <div class="portlet-body scroller" style="height: 500px;">
                <div class="todo-tasklist">
                    <vue-draggable style="min-height: 499px;" v-model="group.stories" :options="draggableOptions"
                                   @change="update($event, group)">
                        <story-card v-for="story in group.stories" :story="story" :key="story.id"/>
                    </vue-draggable>
                </div>
                <div class="todo-tasklist-devider"></div>
            </div>
        </div>
    </div>
</template>

<script>
    import StoryCard from "./StoryCard";
    import VueDraggable from 'vuedraggable'

    export default {
        props: ["group"],
        components: {
            StoryCard, VueDraggable
        },
        data() {
            return {
                draggableOptions: {
                    group: "stories",
                    animation: 150,
                    handle: ".todo-userpic",
                    ghostClass: "sortable-ghost",
                    chosenClass: "sortable-chosen",
                    forceFallback: false,
                    fallbackClass: "sortable-fallback",
                    fallbackOnBody: false,
                    fallbackTolerance: 0,
                }
            }
        },
        methods: {
            update(event, group) {
                console.log(event);
                //console.log(group.id)
            }
        }
    };
</script>