<template>
    <!-- add the navigation here -->
    <div class="flex items-start mx-2 h-screen">
        <column v-for="group in groups" :group="group" :key="group.id"/>
        <new-group />
    </div>
</template>
<script>
    import Column from './Column'
    import NewGroup from './NewGroup'
    import Uploader from './Uploader'

    export default {
        components: {
            NewGroup, Uploader, Column
        },
        props: [],
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
            }
        }
    };
</script>