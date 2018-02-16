<template>
    <file-input multiple accept='image/*' :uploader="uploader"
                class="bg-grey-light opacity-50 p-1 hover:opacity-75 text-xs">
        <font-awesome-icon icon="paperclip"/>
        {{ attachements.length }}
    </file-input>
</template>

<script>
    import FineUploaderTraditional from 'fine-uploader-wrappers'
    import FileInput from 'vue-fineuploader/file-input'

    export default {
        props: ['story'],
        created() {
            this.attachements = this.story.media
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
                                vm.attachements = response.media
                            }
                        }
                    }
                }
            })
            return {
                uploader,
                attachements: []
            }
        },

        components: {
            FileInput
        }
    }
</script>

<style>
    @import url("http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css");
</style>