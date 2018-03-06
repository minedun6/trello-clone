<template>
    <div class="bg-white rounded shadow px-3 py-2 mb-2">
        <div class="flex mb-2 text-grey-darker items-center">
            <span class="h-4 w-4 mr-1">
                <font-awesome-icon class="text-grey-darker fill-current opacity-50" :icon="['far', 'calendar-alt']" />
            </span>
            <span class="opacity-50 text-xs">
                {{ story.due_date | formatedDueDate }}
            </span>
        </div>
        <div class="mb-2">
            <p class="font-medium text-md text-blue-darker">
                Design messages page under projects organisation
            </p>
        </div>
        <div class="flex pt-2 pl-2 justify-between">
            <div class="flex items-end">
                <img v-for="(member, i) in story.members.slice(0, 2)"
                :key="i"
                :src="`https://randomuser.me/api/portraits/med/men/${member.id}.jpg`"
                class="relative w-7 h-7 rounded-full border-2 border-white border-solid inline-block shadow-inner -ml-2"/>
                <div class="bg-grey-light w-7 h-7 relative rounded-full border-2 border-white border-solid inline-block box-shadow -ml-2 cursor-pointer"
                    @click.prevent="$modal.show('members', {story})">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white">
                        <path d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"></path>
                    </svg>
                </div>
            </div>
            <div class="flex items-center justify-between mt-3">
                <!-- another component-->
                <font-awesome-icon class="w-4 h-4 mr-2" size="lg" :icon="['far', 'file']"/>
                <!-- comments component-->
                <font-awesome-icon class="w-4 h-4 mr-2" size="lg" :icon="['far', 'comments']"/>
                <!-- checklist component-->
                <font-awesome-icon class="w-4 h-4 mr-2" size="lg" :icon="['far', 'check-square']"/>
                <media-uploader :story="story"/>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from "moment"
    import MemberPicker from './MemberPicker'
    import MediaUploader from './Uploader'

    export default {
        components: {
            MemberPicker,
            MediaUploader
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
                    ? moment(date).format("D MMM")
                    : moment(date).format("D MMM YYYY");
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
