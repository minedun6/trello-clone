<template>
    <file-input multiple accept='image/*' :uploader="uploader"
                class="card-widget py-2 px-1">
        <font-awesome-icon icon="paperclip" size="lg"/>
        {{ attachments.length }}
    </file-input>
</template>

<script>
    import FineUploaderTraditional from 'fine-uploader-wrappers'
    import FileInput from 'vue-fineuploader/file-input'

    export default {
        props: ['story'],
        created() {
            this.attachments = this.story.media
        },
        data() {
            let token = document.head.querySelector('meta[name="csrf-token"]').content
            let vm = this
            const uploader = new FineUploaderTraditional({
                options: {
                    request: {
                        params: {
                            _token: token
                        },
                        endpoint: `/stories/${this.story.id}/attachments`
                    },
                    callbacks: {
                        onComplete: function(id, name, response) {
                            if (response.success) {
                                vm.attachments = response.media
                            }
                        }
                    }
                }
            })
            return {
                uploader,
                attachments: []
            }
        },

        components: {
            FileInput
        }
    }
</script>

<style>
    .vue-fine-uploader-file-input input[type="file"] {
        overflow: hidden;
    }
</style>
