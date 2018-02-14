<template>
    <file-input multiple accept='image/*' :uploader="uploader" class="bg-grey-darker opacity-50 text-white p-1 rounded hover:opacity-75">
        <font-awesome-icon icon="paperclip"/> {{ files.length }}
    </file-input>
</template>

<script>
    import FineUploaderTraditional from 'fine-uploader-wrappers'
    import FileInput from 'vue-fineuploader/file-input'

    export default {
        props: ['endpoint'],
        data () {
            let token = document.head.querySelector('meta[name="csrf-token"]').content;
            const uploader = new FineUploaderTraditional({
                options: {
                    request: {
                        params: {
                            _token: token
                        },
                        endpoint: this.endpoint
                    }
                }
            })
            return {
                uploader,
                files: []
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