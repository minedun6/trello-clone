<template>
    <modal name="new-group"
           :clickToClose="false"
           height="auto"
           transition="slide"
           :adaptive="true">
        <div class="flex border-b content-between justify-between">
            <p class="text-black text-lg py-4 px-6">Add new column</p>
            <button class="pr-4" @click="$modal.hide('new-group')">
                <font-awesome-icon class="w-4 h-4 mr-2" size="2lg" :icon="['far', 'times-circle']"/>
            </button>
        </div>
        <form class="p-8" @submit.prevent="createNewGroup">
            <div class="mb-12">
                <label for="name" class="block uppercase tracking-normal mb-4 font-bold text-xs text-green-darker">Column
                    name</label>
                <input type="text" class="form-control w-full" id="name"
                       placeholder="Enter a column name (To Do, In Progress, Done)" v-model="group.name">
            </div>
            <div class="flex">
                <button type="submit" class="btn rounded p-3"
                        :class="{'loader': loading, 'cursor-not-allowed' : group.name.length < 1 }"
                        :disabled="loading || group.name.length < 1">Create column
                </button>
                <button type="reset" class="rounded p-3">
                    Cancel
                </button>
            </div>
        </form>
    </modal>
</template>
<script>
    import {defaultGroup} from './../store/defaults'

    export default {
        data() {
            return {
                group: {...this.$store.getters.newGroup},
                loading: false
            }
        },
        methods: {
            createNewGroup() {
                this.loading = true;
                this.$store.dispatch('createNewGroup', this.group)
                    .then(response => {
                        this.loading = false;
                        this.group = {...defaultGroup};
                        this.$modal.hide('new-group');
                    }).catch(err => {
                    this.loading = false;
                    console.error(err)
                });
            }
        }
    }
</script>

<style scoped>

</style>