<script>
    import {defaultStory} from './../store/defaults'
    export default {
        data() {
            return {
                story: {...this.$store.getters.newStory},
                loading: false
            }
        },
        methods: {
            modalOpenedHandler(event) {
                this.story.group_id = event.params.group.id
            },
            createNewStory() {
                this.$store.dispatch('')
            }
        }
    }
</script>
