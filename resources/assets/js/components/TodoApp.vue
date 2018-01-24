<template>
    <div class="portlet bordered light">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject bold">Project #1</span>
            </div>
            <span class="actions">
                <span class="badge">

                </span>
            </span>
        </div>
        <div class="portlet-body">
            <div class="todo-content">
                <story-board v-for="group in groups" :group="group" :key="group.id"/>
            </div>
        </div>
    </div>
</template>

<script>
    import storyBoard from './StoryBoard'

    export default {
        props: ['stories-endpoint'],
        created() {
            this.fetchData();

            this.$eventHub.$on('story.update-group', () => {
                // axios.put('')
            })
        },
        data() {
            return {
                todos: [],
                groups: [],
                story: {
                    title: '',
                    description: ''
                }
            }
        },
        components: {
            storyBoard
        },
        methods: {
            uid() {
                return '_' + Math.random().toString(36).substr(2, 9)
            },
            fetchData() {
                axios.get(this.storiesEndpoint)
                    .then(res => {
                        this.todos = res.data.items;
                        this.groups = res.data.groups;
                    })
            }
        }
    }
</script>