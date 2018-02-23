<template>
    <div class="card">
        <div class="flex justify-start p-4">
            <img class="rounded-full mr-1" src="/img/user.svg" width="30" height="30" />
            <p class="break-words">{{ story.description }}</p>
        </div>
        <div class="flex justify-start bg-grey-lightest h-8">
            <uploader :story="story"/>
            <member-picker :story="story"/>
        </div>
    </div>
</template>

<script>
import moment from "moment"
import MemberPicker from './MemberPicker'

export default {
    components: {
        MemberPicker
    },
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
