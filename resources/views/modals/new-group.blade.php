<new-group-modal inline-template>
    <modal name="new-group" :adaptive="true" height="auto">
        <div class="flex border-b content-between justify-between">
            <p class="text-black text-lg p-6">Add new column</p>
            <button class="pr-6" @click="$modal.hide('new-group')">x</button>
        </div>
        <form class="p-8" @submit.prevent="createNewGroup">
            <div class="mb-12">
                <label for="name" class="block uppercase tracking-normal mb-4 font-bold text-xs text-green-darker">Column
                    name</label>
                <input type="text" class="form-control w-full" id="name"
                       placeholder="Enter a column name (To Do, In Progress, Done)" v-model="group.name">
            </div>
            <div class="flex">
                <button type="submit" class="btn p-2 rounded"
                                 :class="{'loader': loading, 'cursor-not-allowed' : group.name.length < 1 }" :disabled="loading || group.name.length < 1">Create column
                </button>
                <button type="reset" class="btn p-2 rounded bg-red">
                    Cancel
                </button>
            </div>
        </form>
    </modal>
</new-group-modal>