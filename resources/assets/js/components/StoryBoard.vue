<template>
    <div class="col-md-4 column sortable">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bar-chart font-green-sharp hide"></i>
                    <span class="caption-subject font-green-sharp bold uppercase">{{ group.name }}</span>
                </div>
                <div class="actions">
                    <div class="btn-group">
                        <a class="btn default text-white btn-circle btn-sm" data-toggle="modal" href="#story-modal"
                           @click.prevent="initModal">
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- end PROJECT HEAD -->
            <div class="portlet-body scroller" style="height: 500px;">
                <div class="todo-tasklist">
                    <vue-draggable style="min-height: 499px;" v-model="group.stories" :options="draggableOptions"
                                   @change="update($event, group)">
                        <story-card v-for="story in group.stories" :story="story" :key="story.id"/>
                    </vue-draggable>
                </div>
                <div class="todo-tasklist-devider"></div>
            </div>
        </div>
        <div id="story-modal" class="modal fade" role="dialog" ref="modal">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 v-html="storyModalTitle"></h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="story-title" class="label-control">Title</label>
                                <input type="text" class="form-control" id="story-title" v-model="story.title">
                            </div>

                            <div class="form-group">
                                <label for="story-description" class="label-control">Description</label>
                                <textarea id="story-description" cols="10" rows="5"
                                          class="form-control no-resize" v-model="story.description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="story-due-date" class="label-control">Due Date</label>
                                <input type="date" id="story-due-date" class="form-control" v-model="story.due_date">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                        <button type="button" class="btn green" data-dismiss="modal" @click="saveStory">Save</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import StoryCard from "./StoryCard"
    import VueDraggable from 'vuedraggable'

    export default {
        props: ["group"],
        components: {
            StoryCard, VueDraggable
        },
        data() {
            return {
                draggableOptions: {
                    group: "stories",
                    animation: 150,
                    handle: ".todo-userpic",
                    ghostClass: "sortable-ghost",
                    chosenClass: "sortable-chosen",
                    forceFallback: false,
                    fallbackClass: "sortable-fallback",
                    fallbackOnBody: false,
                    fallbackTolerance: 0,
                },
                story: {
                    title: '',
                    description: '',
                    due_date: '',
                    group_id: this.group.id
                },
                storyModalTitle: ''
            }
        },
        methods: {
            update(event, group) {
                console.log(event);
                console.log(group)
            },
            toggleModal() {
                this.$eventHub.$emit('open-modal', this.group);
            },
            initModal() {
                this.storyModalTitle = 'Create A new Story'
            },
            saveStory() {
                // axios create
                axios.post('/stories', this.story)
                    .then((response) => {
                        if (response.data.success) {
                            this.group.stories.push(response.data.story);
                        }
                    });
            }
        }
    };
</script>

<style>
    .no-resize {
        resize: none;
    }
</style>