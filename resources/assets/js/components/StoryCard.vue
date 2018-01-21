<template>
    <div class="todo-tasklist-item">
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
            </span>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'

    export default {
        props: ["story"],
        filters: {
            dueDate(date) {
                return moment(date).fromNow();
            }
        }
    };
</script>

<style>
    .chosen {
        opacity: 1;
    }
    .ghost {
        opacity: 1;
    }
</style>