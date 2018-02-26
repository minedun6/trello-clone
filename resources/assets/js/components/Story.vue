<template>
    <div class="bg-white rounded shadow px-3 py-2 mb-2">
        <div class="flex mb-1 text-grey-darker opacity-50">
            <span class="h-4 w-4">
                <svg class="text-grey-darker" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M17 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h2V3a1 1 0 1 1 2 0v1h6V3a1 1 0 0 1 2 0v1zm-2 2H9v1a1 1 0 1 1-2 0V6H5v4h14V6h-2v1a1 1 0 0 1-2 0V6zm4 6H5v8h14v-8z"></path>
                </svg>
            </span>
            <span class="">
                {{ story.due_date | formatedDueDate }}
            </span>
        </div>
        <div class="mb-2">
            <p class="font-medium text-md text-blue-darker">
                Design messages page under projects organisation
            </p>
        </div>
        <div class="flex pt-2 pl-2">
            <img src="https://randomuser.me/api/portraits/med/men/1.jpg"
                 class="relative w-7 h-7 rounded-full border-2 border-white border-solid inline-block box-shadow -ml-2"/>
            <img src="https://randomuser.me/api/portraits/med/men/1.jpg"
                 class="relative w-7 h-7 rounded-full border-2 border-white border-solid inline-block box-shadow -ml-2"/>
            <img src="https://randomuser.me/api/portraits/med/men/1.jpg"
                 class="relative w-7 h-7 rounded-full border-2 border-white border-solid inline-block box-shadow -ml-2"/>
            <div class="bg-grey-light w-7 h-7 relative rounded-full border-2 border-white border-solid inline-block box-shadow -ml-2 cursor-pointer"
                 @click.prevent="$modal.show('members', {story})">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white">
                    <path d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"></path>
                </svg>
            </div>
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
