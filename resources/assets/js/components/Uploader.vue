<template>
    <file-input multiple accept='image/*' :uploader="uploader">
        <font-awesome-icon class="w-4 h-4" :icon="['far', 'hdd']" size="lg"/>
        {{ attachments.length }}
    </file-input>
</template>

<script>
    import FineUploaderS3 from 'fine-uploader-wrappers/s3'
    import FileInput from 'vue-fineuploader/file-input'

    export default {
        props: ['story'],
        created() {
            this.attachments = this.story.media
        },
        data() {
            let token = document.head.querySelector('meta[name="csrf-token"]').content;
            let vm = this;
            const uploader = new FineUploaderS3({
                options: {
                    request: {
                        endpoint: "https://trello-clone-v2.s3.amazonaws.com",
                        accessKey: "AKIAJFGV22ZSZP45WLBQ"
                    },
                    signature: {
                        customHeaders: {
                            csrfToken: token
                        },
                        endpoint: "/aws/signature",
                        version: 4
                    },
                    uploadSuccess: {
                        params: {
                            _token: token
                        },
                        endpoint: `/stories/${this.story.id}/attachments`
                    },
                    iframeSupport: {
                        localBlankPagePath: "success.html"
                    },
                    chunking: {
                        enabled: true,
                        concurrent: {
                            enabled: true
                        }
                    },
                    resume: {
                        enabled: true
                    },
                },
                callbacks: {
                    onComplete: function (id, name, response) {
                        if (response.success) {
                            vm.attachments = response.media
                        }
                    }
                }
            });
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
        width: 0;
        height: 0;
        overflow: hidden;
    }
</style>
