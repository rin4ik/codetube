
  <template>
        <div style="display:inline-block">
           <a @click="show"    class="btn btn-outline-default btn-sm ">Edit</a>
          <transition enter-active-class="animated fadeInUpBig" leave-active-class="animated shake" mode="out-in" appear>


          <modal :name="`update-${video.id}`"    >
               <form @submit.prevent="update">
                           
                          
            <div class="modal-header " >
                    <h5 class="modal-title" style="text-align:center;">Update  </h5>
            </div>
               <div class="card-body " style="background:#fbfbfc"  >
                   
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" 
                             v-model="video.title">
                          
                        </div>
                        <div class="form-group">
                                <label for="description">Descrition</label>
                                <textarea name="description" id="description" class="form-control" v-model="video.description">  
                                </textarea>
                        
                            </div>
                            <div class="form-group">
                              <label for="visibility">Visibility</label>
                                    <select name="visibility" id="visibility" class="form-control"  > 
                                    </select>
                            
                                </div>
                                <div class="form-group">
                                    <label for="allow_votes">
                                        <input type="checkbox" name="allow_votes" id="allow_votes"  > Allow votes
                                    </label>
                                </div>
                                <div class="form-group">
                                        <label for="allow_comments">
                                            <input type="checkbox" name="allow_comments" id="allow_comments"  > Allow comments
                                        </label>
                                    </div>
                                    <button  >Update</button>
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
        title: "",
        description: "",
        visibility: ""
      }
    };
  },
  methods: {
    show() {
      this.$modal.show(`update-${this.video.id}`);
    }
  }
};
</script>