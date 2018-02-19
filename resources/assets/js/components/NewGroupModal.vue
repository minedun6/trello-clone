<script>
    import {defaultGroup} from './../store/defaults'
    export default {
        data() {
            return {
                group: {...this.$store.getters.newGroup},
                loading: false
            }
        },
        methods: {
            createNewGroup() {
                this.loading = true;
                this.$store.dispatch('createNewGroup', this.group)
                    .then(response => {
                        this.loading = false;
                        this.group = {...defaultGroup};
                        this.$modal.hide('new-group');
                    }).catch(err => {
                        this.loading = false;
                        console.error(err)
                    });
            }
        }
    }
</script>

<style scoped>

</style>