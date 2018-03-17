<login inline-template>
<modal name="login" height="auto" width="550px">
    <div style="padding-top:20px; " >

            <form @submit.prevent="login">
                            <div class="card-body" style="margin-top:20px;">
                          
            
                  <div class="form-group row">
                                        <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
            
                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control" name="email" v-model="form.email" autocomplete="email" required autofocus>
             
                                        </div>
                                    </div>
            
                                    <div class="form-group row" style="margin-top:30px;margin-bottom:30px">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
            
                                        <div class="col-md-6  " >
                                            <input id="password" type="password" class="form-control" name="password" v-model="form.password" autocomplete="current-password" required>             
                                        </div>
                                    </div>
            
                                    <div class="form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                      <div class="modal-footer " style="">
                                            <button type="submit" class="btn btn-outline-primary btn-sm" >
                                                {{ __('Login') }}
                                            </button>
            
                                            <a   class="btn btn-outline-info btn-sm" @click="register" >
                                                  <span style="text-muted;"> {{ __('or register') }}</span> 
                                            </a>
                                    </div>
                                    <div  v-if="feedback">
                                            <span  style="color:red" v-text="feedback" ></span>
                                    </div>
                                
                            </div>
                        </form>
    </div>
    
</modal>
</login>