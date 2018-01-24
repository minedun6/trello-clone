<template>
    <div :id="id" class="modal fade" role="dialog" ref="modal" v-show="state">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <slot name="header"/>
                </div>
                <div class="modal-body">
                    <slot name="body"/>
                </div>
                <div class="modal-footer">
                    <slot name="footer"/>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props: ["id"],
        mounted() {
            this.$eventHub.$on('open-modal', (payload) => {
                $(this.$refs.modal).modal('show');
                this.$eventHub.$emit('set-data-modal', payload);
            });
            this.$eventHub.$on('close-modal', (payload) => {
                $(this.$refs.modal).modal('hide')
            });
        },
        data() {
            return {
                state: false
            };
        },
        methods: {}
    };
</script>

<style>
    .no-resize {
        resize: none;
    }
</style>