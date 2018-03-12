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
      uploading: false,
      uploadingComplete: false,
      failed: false
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    fileInput() {
      this.uploading = true;
      this.failed = false;
    }
  }
};
</script>
