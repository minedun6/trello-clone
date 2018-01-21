<template>
    <div class="col-md-4 column sortable" :id="group.id">
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
                  <story-card v-for="(item, index) in group.stories" :story="item" :key="index"/>
                </div>
                <div class="todo-tasklist-devider"></div>
            </div>
        </div>
    </div>
</template>

<script>
import StoryCard from "./StoryCard";

export default {
    props: ["group"],
    components: {
        StoryCard
    }
};
</script>