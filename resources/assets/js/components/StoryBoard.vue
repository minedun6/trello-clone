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
                    <vue-draggable style="min-height: 499px;" v-model="group.stories" :options="draggableOptions" @start="drag=true" @end="drag=false">
                        <story-card v-for="(item, index) in group.stories" :story="item" :key="index"/>
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
                draggableOptions: {group: 'stories', animation: 150, 'ghostClass': 'ghost', 'chosenClass': 'chosen'}
            }
        }
    };
</script>