<template>
    <div class="modal fade" tabindex="-1" ref="storyModal" role="dialog" id="storyModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add a new column</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="group-name" class="label-control">Column name</label>
                        <input type="text" class="form-control" id="group-name" v-model="newGroup.name" placeholder="Enter a column name (To Do, In Progress, Done)">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn green"
                            :disabled="newGroup.name.length < 1"
                            @click.prevent="createNewGroup"
                    >
                        Create column
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</template>

<script>
    export default {
        computed: {
            newGroup() {
                return this.$store.getters.newGroup
            }
        },
        methods: {
            createNewGroup() {
                this.$store.dispatch('createNewGroup', this.newGroup).then(res => {
                    // handle success
                    $(this.$refs.storyModal).modal('hide');
                }).catch(err => {
                    // handle errors
                })
            }
        }
    }
</script>

<style scoped>

</style>