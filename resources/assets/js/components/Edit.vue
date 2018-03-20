
  <template>
        <div style="display:inline-block">
           <a @click="show"    class="btn btn-outline-default btn-sm ">Edit</a>
          <transition enter-active-class="animated fadeInUpBig" leave-active-class="animated shake" mode="out-in" appear>


          <modal :name="`update-${video.id}`" height="auto" width="550px" >
               <form @submit.prevent="update">
                           
                          
       
               <div class="card-body " style="background:#fbfbfc"  >
                        <div class="modal-header " >
                    <h5 class="modal-title" style="text-align:center;">UPDATE    </h5>
            </div>
                        <div class="form-group" style="padding-top:30px;">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" 
                             v-model="form.title">
                          
                        </div>
                        <div class="form-group">
                                <label for="description">Descrition</label>
                                <textarea name="description" id="description" class="form-control" v-model="form.description">  
                                </textarea>
                        
                            </div>
                            <div class="form-group">
                              <label for="visibility">Visibility</label>
                                    <select name="visibility" id="visibility" class="form-control" v-model="form.visibility" > 
                                      <option v-for="visibility in ['private','public','unlisted']">{{visibility}}</option>
                                    </select>
                            
                                </div>
                                <div class="form-group">
                                    <label for="allow_votes">
                                        <input type="checkbox" v-model="form.allow_votes"   v-bind:true-value="1"
  v-bind:false-value="0"> Allow votes
                                    </label>
                                </div>
                                <div class="form-group">
                                        <label for="allow_comments">
                                            <input type="checkbox"   v-model="form.allow_comments"   v-bind:true-value="1"
  v-bind:false-value="0"> Allow comments
                                        </label>
                                    </div>
                                <div class="modal-footer" style="background:#f5f8fa;border:1px solid rgb(204, 208, 211);">
                                    <button type="submit" class="btn btn-success btn-sm" :class="loading ?  'loader':''">
                                        Update 
                                    </button>
                                      <a   class="btn btn-danger btn-sm" @click="$modal.hide(`update-${video.id}`)" >
                                        CAncel
                                  </a>
                                </div>
                                    </div>
                        </form>

          </modal>
        </transition>
        </div>
        
  </template>

  <script>
export default {
  props: ["video"],
  data() {
    return {
      feedback: "",
      loading: false,
      form: {
        title: this.video.title,
        description: this.video.description,
        visibility: this.video.visibility,
        allow_votes: this.video.allow_votes,
        allow_comments: this.video.allow_comments
      }
    };
  },
  filters: {
    capitalize: function(value) {
      if (!value) return "";
      value = value.toString();
      return value.charAt(0).toUpperCase() + value.slice(1);
    }
  },
  methods: {
    update() {
      console.log(this.form);
      this.loading = true;
      this.$http
        .put("/videos/" + this.video.uid, this.form)
        .then(response => {
          this.loading = false;
        })
        .catch(error => {
          this.feedback = error.response.data.errors;
          this.loading = false;
        });
    },

    show() {
      this.$modal.show(`update-${this.video.id}`);
    }
  }
};
</script>