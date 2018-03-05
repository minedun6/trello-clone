<template>
    <file-input multiple accept='image/*' :uploader="uploader">
        <font-awesome-icon class="w-4 h-4" :icon="['far', 'hdd']" size="lg"/>
        {{ attachments.length }}
    </file-input>
</template>

<script>
import FineUploaderTraditional from 'fine-uploader-wrappers'
import FileInput from "vue-fineuploader/file-input";

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
          onComplete: function(id, name, response) {
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
    FileInput
  }
};
</script>

<style>
.vue-fine-uploader-file-input input[type="file"] {
  width: 0;
  height: 0;
  overflow: hidden;
}
</style>
