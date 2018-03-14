<template>
    <modal name="new-story"
           :clickToClose="false"
           height="auto"
           transition="slide"
           @before-open="modalOpenedHandler"
           :adaptive="true">
        <div class="flex border-b content-between justify-between">
            <p class="text-black text-lg py-4 px-6">Add new story</p>
            <button class="pr-4" @click="$modal.hide('new-story')">
                <font-awesome-icon class="w-4 h-4 mr-2" size="2lg" :icon="['far', 'times-circle']"/>
            </button>
        </div>
        <form class="p-8" @submit.prevent="createNewStory">
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
            <div class="mb-4">
                <label for="due_date"
                       class="block uppercase tracking-normal mb-4 font-bold text-xs">Tags</label>
                <inline-tags-input v-model="story.tags"></inline-tags-input>
            </div>
            <div class="flex">
                <button type="submit" class="btn p-3 rounded"
                        :class="{'loader': loading, 'cursor-not-allowed' : story.title.length < 1 }" :disabled="loading || story.title.length < 1">
                    <span class="flex">
                        <font-awesome-icon class="w-4 h-4 mr-2" size="lg" :icon="['fas', 'plus']"/>
                        Create Story
                    </span>
                </button>
            </div>
        </form>
    </modal>
</template>
<script>
    import {defaultStory} from './../store/defaults'

    export default {
        data() {
            return {
                story: {...this.$store.getters.newStory},
                loading: false,
            }
        },
        methods: {
            modalOpenedHandler(event) {
                this.story.group_id = event.params.group.id
            },
            createNewStory() {
                this.loading = true;
                this.$store.dispatch('createNewStory', {story: this.story})
                    .then(response => {
                        this.loading = false;
                        this.group = {...defaultStory};
                        this.$modal.hide('new-story');
                }).catch(err => {
                    this.loading = false;
                    console.error(err)
                });
            }
        }
    }
</script>

<style>
    .enter { transform: translateX(100%) }
    .enter-to { transform: translateX(0) }
    .slide-enter-active { position: absolute }

    .leave { transform: translateX(0) }
    .leave-to { transform: translateX(-100%) }

    .slide-enter-active,
    .slide-leave-active { transition: all 750ms ease-in-out }
</style>