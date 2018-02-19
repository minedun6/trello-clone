<new-story-modal inline-template>
    <modal name="new-story" :adaptive="true" height="auto" @before-open="modalOpenedHandler">
        <div class="flex border-b content-between justify-between">
            <p class="text-black text-lg p-6">Add new story</p>
            <button class="pr-6" @click="$modal.hide('new-story')">x</button>
        </div>
        <form class="p-8" @submit.prevent="createNewGroup">
            <div class="mb-4">
                <label for="description"
                       class="block uppercase tracking-normal mb-4 font-bold text-xs">Description</label>
                <textarea class="form-control w-96 h-36 resize-none" id="description"
                          placeholder="Description"
                          v-model="story.title">
                </textarea>
            </div>
            <div class="mb-4">
                <label for="due_date"
                       class="block uppercase tracking-normal mb-4 font-bold text-xs">Title</label>
                <input type="date" 
                       class="form-control w-full" 
                       id="due_date"
                       placeholder="Pick a date"
                       v-model="story.due_date"/>
            </div>
            <div class="flex">

            </div>
        </form>
    </modal>
</new-story-modal>