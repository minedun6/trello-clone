<template>
    <div class="bg-white rounded shadow px-3 py-2 mb-2 fixed w-64" :style="draggedPosition">
        <div class="flex mb-1 text-grey-darker">
            <span class="h-4 w-4 mr-1">
                <svg class="text-grey-darker fill-current opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M17 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h2V3a1 1 0 1 1 2 0v1h6V3a1 1 0 0 1 2 0v1zm-2 2H9v1a1 1 0 1 1-2 0V6H5v4h14V6h-2v1a1 1 0 0 1-2 0V6zm4 6H5v8h14v-8z"></path>
                </svg>
            </span>
            <span class="opacity-50">
                20 Avr
            </span>
        </div>
        <div class="mb-2">
            <p class="font-medium text-md text-blue-darker">
                Design messages page under projects organisation
            </p>
        </div>
        <div class="flex pt-2 pl-2 justify-between">
            <div class="flex">

            </div>
        </div>
    </div>
</template>

<script>
    import moment from "moment"

    export default {
        mounted() {
            this.$eventHub.$on('start-drag', ({x, y}) => {
                this.x = x
                this.y = y
            })
        },
        data() {
            return {
                x: 0,
                y: 0
            }
        },
        computed: {
            cardBorderStyle() {
            },
            draggedPosition() {
                return `left: ${this.x}px; top: ${this.y}px;`
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
</style>
