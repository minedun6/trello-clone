<template>
    <div class="todo-tasklist-item" :id="story.id">
        <img class="todo-userpic pull-left"
             src="http://keenthemes.com/preview/metronic/theme/assets/pages/media/users/avatar4.jpg"
             width="27px" height="27px">
        <div class="todo-tasklist-item-title" v-html="story.title"></div>
        <div class="todo-tasklist-item-text"
             v-html="story.description"></div>
        <div class="todo-tasklist-controls pull-left">
                    <span class="todo-tasklist-date">
                        <i class="fa fa-calendar"></i> {{ story.due_date | dueDate}}
                    </span>
            <span v-for="tag in story.tags" :key="tag.id">
                <span class="todo-tasklist-badge badge badge-roundless">{{ tag.name }}</span>
                &nbsp;
            </span>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'
    import disableSelection from 'jquery-ui/ui/disable-selection'
    import sortable from 'jquery-ui/ui/widgets/sortable'

    export default {
        props: ["story"],
        mounted() {
            let _vm = this;
            $(".sortable").sortable({
                connectWith: ".column",
                items: ".todo-tasklist-item",
                coneHelperSize: true,
                placeholder: "portlet-sortable-placeholder",
                forcePlaceholderSize: true,
                tolerance: "pointer",
                helper: "clone",
                receive: function (event, ui) {
                    let group = event.target.id;
                    let draggedStory = ui.item.attr('id');
                    axios.patch(`/stories/${draggedStory}`, {
                        targetGroup: group
                    }).then(res => {
                        _vm.$eventHub.$emit('story.update', {data: res.data})
                    })
                }
            }).disableSelection();
        },
        filters: {
            dueDate(date) {
                return moment(date).fromNow();
            }
        }
    };
</script>

<style>

</style>