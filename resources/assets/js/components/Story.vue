<template>
    <div class="card" :style="cardBorderStyle">
        <p class="p-2 break-words">{{ story.description }}</p>
        <div class="text-grey-darker mt-2 ml-2 flex justify-between items-end p-1">
            <div class="flex items-center">
                <font-awesome-icon class="mr-1" icon="clock"/>
                <time>{{ story.due_date | formatedDueDate }}</time>
            </div>
            <img :src="`https://randomuser.me/api/portraits/med/men/${story.id}.jpg`" width="30"
                    height="30"
                    class="rounded-full"/>
        </div>
        <!--<div class="flex justify-end">-->
            <!--<uploader :story="story"/>-->
        <!--</div>-->
    </div>
</template>

<script>
import moment from "moment"

export default {
    props: ['story', 'group'],
    computed: {
        cardBorderStyle() {
            return 'border-left : 2px solid ' + this.group.color_class;
        }
    },
    filters: {
        formatedDueDate(date) {
            let year = moment(date).format("YYYY");
            let currentYear = moment().format("YYYY");
            return year === currentYear
                ? moment(date).format("D MMM.")
                : moment(date).format("D MMM. YYYY");
        }
    }
};
</script>

<style scoped>
    .card {
        cursor: grab;
    }

    .card:active {
        cursor: grabbing;
    }
</style>
