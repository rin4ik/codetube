<edit inline-template>
    <transition enter-active-class="animated fadeInUpBig" leave-active-class="animated shake" mode="out-in" appear>


        <modal name="edit" height="auto" width="530px">
            <div class="card-body" style="background:#fbfbfc">
                <div class="modal-header ">
                    <h5 class="modal-title" style="text-align:center;">EDIT  </h5>
                </div>
                <form @submit.prevent="edit">
                        <div class="form-group" style="padding-top:20px">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" name="title" 
                                 >
                   
                            </div>
                            <div class="form-group">
                                    <label for="description">Descrition</label>
                                    <textarea name="description" id="description" class="form-control" > 
                                    </textarea>
                                  
                                </div>
                                <div class="form-group">
                                  <label for="visibility">Visibility</label>
                                        <select name="visibility" id="visibility" class="form-control"  >
                                            @foreach(['public','unlisted','private'] as $visibility)
                                            <option value="{{$visibility}}"  >{{ucfirst($visibility)}}</option>
                                            @endforeach
                                        </select>
                                
                                    </div>
                                    <div class="form-group">
                                        <label for="allow_votes">
                                            <input type="checkbox" name="allow_votes" id="allow_votes" > Allow votes
                                        </label>
                                    </div>
                                    <div class="form-group">
                                            <label for="allow_comments">
                                                <input type="checkbox" name="allow_comments" id="allow_comments"  > Allow comments
                                            </label>
                                        </div>

                 

                    <div class="modal-footer" style="background:#f5f8fa;border:1px solid rgb(204, 208, 211);">
                        <button type="submit" :class="loading ?  'loader':''" class="btn btn-outline-primary btn-sm">
                            {{ __('Update') }}
                        </button>

                        <a class="btn btn-outline-danger btn-sm" @click="$modal.hide('edit')">
                            CAncel
                        </a>
                    </div>
                    <div v-for="feed in feedback">
                        <span style="color:red" v-text="feed"></span>
                        <br>
                    </div>
                </form>
            </div>

        </modal>
    </transition>
</edit>