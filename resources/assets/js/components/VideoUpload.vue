<template>

  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Upload</div>

                <div class="card-body">
                    <input type="file" name="video" id="video" @change="fileInput" v-if="!uploading">
                    <div id="uploading" v-if="uploading && !failed">
                            Form
                    </div>  
               </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
  data() {
    return {
      uid: null,
      uploading: false,
      uploadingComplete: false,
      failed: false,
      title: "Untitled",
      description: null,
      visibility: "private"
    };
  },
  methods: {
    fileInput() {
      this.uploading = true;
      this.failed = false;
      this.file = document.getElementById("video").files[0];
      this.store().then(() => {});
    },
    store() {
      return this.$http
        .post("/videos", {
          title: this.title,
          description: this.description,
          visibility: this.visibility,
          extension: this.file.name.split(".").pop()
        })
        .then(response => {
          this.uid = response.body.data.uid;
        });
    }
  }
};
</script>
