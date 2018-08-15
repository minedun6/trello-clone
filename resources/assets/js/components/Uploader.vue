<template>
    <div>
        <file-input multiple accept='image/*' :uploader="uploader">
            <font-awesome-layers class="fa-lg" :class="[attachments.length > 0 ? 'opacity-75 hover:opacity-100' : 'opacity-25 hover:opacity-50']">
                <font-awesome-icon :icon="['far', 'hdd']"/>
                <span class="fa-layers-counter" v-show="attachments.length > 0">.</span>
            </font-awesome-layers>
        </file-input>
    </div>
</template>

<script>
    import FineUploaderTraditional from 'fine-uploader-wrappers'
    import FileInput from 'vue-fineuploader/file-input'
    import ProgressBar from 'vue-fineuploader/progress-bar'

    export default {
        props: ["story"],
        created() {
            this.attachments = this.story.media;
        },
        data() {
            let token = document.head.querySelector('meta[name="csrf-token"]').content;
            let vm = this;

            const uploader = new FineUploaderTraditional({
                options: {
                    debug: true,
                    request: {
                        params: {
                            _token: token
                        },
                        endpoint: `/stories/${this.story.id}/attachments`,
                        method: 'POST'
                    },
                    callbacks: {
                        onComplete: function (id, name, response) {
                            if (response.success) {
                                vm.attachments = response.media;
                            }
                        }
                    }
                }
            });
            return {
                uploader,
                attachments: []
            };
        },

        components: {
            FileInput,
            ProgressBar
        }
    };
</script>

<style>
    /* Overrides */
    .vue-fine-uploader-file-input input[type="file"] {
        width: 0;
        height: 0;
        overflow: hidden;
    }
    .fa-layers-counter {
        height: 1.25em;
        min-width: 1.25em;
    }
</style>
