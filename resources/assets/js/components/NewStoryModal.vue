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
