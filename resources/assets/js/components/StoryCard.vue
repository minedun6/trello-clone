<template>
    <div :class="['todo-tasklist-item', 'todo-tasklist-item-border-' + group.color_class]">
        <div class="todo-tasklist-item-header-container">
            <div class="todo-tasklist-item-header-content">
                <img class="todo-user-picture pull-left" src="/img/user.svg" width="30" height="30">
                <div class="todo-tasklist-item-title" v-html="story.title"></div>
            </div>
            <div class="todo-tasklist-item-actions">
                <b-btn v-b-modal.myModal class="btn default btn-sm">
                    <i class="fas fa-ellipsis-h"></i>
                </b-btn>
            </div>
        </div>
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
        props: ["story", "group"],
        filters: {
            dueDate(date) {
                return moment(date).fromNow();
            }
        }
    };
</script>

<style>
    .todo-tasklist-item {
        cursor: move !important;
    }

    .sortable-ghost {
        color: #EAEAEA;
        background-color: #EAEAEA;
        border: 1px dashed #aaa;
    }

    .sortable-chosen:not(.sortable-ghost) {
        color: #224466;
        background-color: #2299ff;
    }

    .sortable-drag {
        color: #449922;
        background-color: #44ff33;
    }

    .todo-tasklist-item-header-container {
        display: inline-flex;
        align-items: flex-start;
        width: 100%;
        justify-content: space-between;
    }

    .todo-tasklist-item-header-content {
        display: inline-flex;
    }

    .todo-tasklist-item img {
        margin-right: 5px !important;
    }

    .todo-user-picture {
        min-height: 30px;
        min-width: 30px;
    }

</style>
