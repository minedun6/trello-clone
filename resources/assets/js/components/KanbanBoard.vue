<template>
    <!-- add the navigation here -->
    <div class="flex items-start ml-2 h-screen overflow-x-scroll">
        <div v-for="group in groups" :key="group.id"
             class="rounded bg-grey-light flex-no-shrink w-80 mr-3">
            <div class="flex justify-between pt-3 px-4">
                <h3 class="text-sm text-grey-darker">
                    <div class="flex">
                        <div class="flex rounded-full bg-grey-darker text-white uppercase px-2 py-1 text-xs mr-3">
                            {{ group.stories.length}}
                        </div>
                        {{ group.name }}
                    </div>
                </h3>
                <svg class="h-4 fill-current text-grey-dark cursor-pointer" xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 24 24">
                    <path d="M5 10a1.999 1.999 0 1 0 0 4 1.999 1.999 0 1 0 0-4zm7 0a1.999 1.999 0 1 0 0 4 1.999 1.999 0 1 0 0-4zm7 0a1.999 1.999 0 1 0 0 4 1.999 1.999 0 1 0 0-4z"></path>
                </svg>
            </div>
            <div class="card-list">
                <vue-draggable :options="draggableOptions.stories" :list="group.stories" class="h-full">
                    <div class="card" :style="cardBorderStyle(group)" v-for="story in group.stories" :key="story.id">
                        <p>{{ story.title }}</p>
                        <div class="text-grey-darker mt-2 ml-2 flex justify-between items-end">
                            <div class="flex items-center">
                                <font-awesome-icon class="mr-1" icon="clock"/>
                                <time>{{ story.due_date | formatedDueDate }}</time>
                            </div>
                            <img :src="`https://randomuser.me/api/portraits/med/men/${story.id}.jpg`" width="30"
                                 height="30"
                                 class="rounded-full"/>
                        </div>
                    </div>
                </vue-draggable>
            </div>
            <a href="#"
               class="p-2 text-grey-dark no-underline hover:underline hover:text-grey-darkest static clearfix hover:bg-grey rounded-b w-full h-full pin-b inline-block">
                Add a card ...
            </a>
        </div>
    </div>
</template>
<script>
    import VueDraggable from 'vuedraggable'
    import Navigation from './Navigation'
    import moment from "moment";
    import {draggableOptions} from './config'

    export default {
        components: {
            VueDraggable, Navigation
        },
        props: [],
        data() {
            return {
                draggableOptions
            }
        },
        computed: {
            groups() {
                return this.$store.getters.groups;
            }
        },
        mounted() {
            this.fetchData();
        },
        methods: {
            fetchData() {
                this.$store.dispatch("fetchData");
            },
            cardBorderStyle(group) {
                return 'border-left : 2px solid ' + group.color_class;
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

<style>
    .card {
        cursor: grab;
    }

    .card:active {
        cursor: grabbing;
    }

    .sortable-ghost, .sortable-chosen {
        cursor: grabbing;
    }
</style>
