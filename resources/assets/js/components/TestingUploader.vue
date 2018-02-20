<template>
    <Gallery :uploader="uploader" />
</template>

<script>
    import FineUploaderTraditional from 'fine-uploader-wrappers'
    import Gallery from 'vue-fineuploader/gallery'

    export default {
        components: {
            Gallery
        },
        data () {
            let token = document.head.querySelector('meta[name="csrf-token"]').content
            const uploader = new FineUploaderTraditional({
                options: {
                    deleteFile: {
                        enabled: true,
                        endpoint: 'my/upload/endpoint'
                    },
                    request: {
                        params: {
                            _token: token
                        },
                        endpoint: '/stories/1/attachments'
                    }
                }
            })

            return {
                uploader
            }
        }
    }
</script>