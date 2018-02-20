<template>
    <file-input multiple accept='image/*' :uploader="uploader"
                class="bg-grey-light opacity-50 p-1 hover:opacity-75 text-xs">
        <font-awesome-icon icon="paperclip"/>
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
                        endpoint: `/stories/${this.story.id}/attachements`
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