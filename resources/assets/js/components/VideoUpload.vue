<template>

  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Upload</div>

                <div class="card-body">
                    <input type="file"  name="video" id="video" @change="fileInput" v-if="!uploading">
                    
                    <div class="alert alert-danger" v-if="failed">
                      Something went wrong. Please try again
                    </div>

                    <div id="video-form" v-if="uploading && !failed">
                      <div class="alert alert-info" v-if="!uploadingComplete">
                        Your video will be available at <a :href="$root.url+'/videos/'+uid" target="_blank">{{$root.url}}/videos/{{uid}}</a>.
                      </div>
                      <div class="alert alert-success" v-if="uploadingComplete">
                        Upload complete. Video now processing. <a href="/videos">Go to your videos</a>
                      </div>
                      <div class="progress" v-if="!uploadingComplete">
                          <div class="progress-bar" v-bind:style="{width:fileProgress + '%'}">

                          </div>
                      </div>
                            <div class="form-group">
                              <label for="title">Title</label>
                              <input type="text"  class="form-control" v-model="title">
                            </div>

                            <div class="form-group">
                              <label for="description">Description</label>
                              <textarea class="form-control" v-model="description"></textarea>
                            </div>
                               
                            <div class="form-group">
                              <label for="Visibility">Visibility</label>
                              <select class="form-control" v-model="visibility">
                                <option value="private">Private</option>
                                <option value="unlisted">Unlisted</option>
                                <option value="public">Public</option>
                              </select>
                            </div> 
                            <button class="btn btn-outline-success btn-sm" type="submit" @click.prevent="update" style="padding-right:10px ; padding-left:10px">Save changes</button>
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
      visibility: "private",
      fileProgress: 0
    };
  },
  methods: {
    fileInput() {
      this.uploading = true;
      this.failed = false;
      this.file = document.getElementById("video").files[0];
      this.store().then(
        () => {
          var form = new FormData();
          form.append("video", this.file);
          form.append("uid", this.uid);

          this.$http
            .post("/upload", form, {
              progress: e => {
                if (e.lengthComputable) {
                  this.updateProgress(e);
                }
              }
            })
            .then(
              () => {
                this.uploadingComplete = true;
              },
              () => {
                this.failed = true;
              }
            );
        },
        () => {
          this.failed = true;
        }
      );
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
    },
    update() {
      return this.$http
        .put("/videos/" + this.uid, {
          title: this.title,
          description: this.description,
          visibility: this.visibility
        })
        .then(
          response => {
            flash("Changes saved!", "success");
            this.saveStatus = "Changes saved.";
          },
          () => {
            flash("Failed to save changes!", "danger");
          }
        );
    },
    updateProgress(e) {
      e.percent = e.loaded / e.total * 100;
      this.fileProgress = e.percent;
    }
  },
  mounted() {
    window.onbeforeunload = () => {
      if (this.uploading && !this.uploadingComplete && !this.failed) {
        return "Are you sure you want to navigate away";
      }
    };
  }
};
</script>
