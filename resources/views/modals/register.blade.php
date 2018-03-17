<register inline-template>
        <modal name="register" height="auto" width="530px">
                <div class="card-body" style="padding-top:50px">
                        <form  @submit.prevent="register">
                          
    
                            <div class="form-group row" style="margin-bottom:30px">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"  v-model="form.name" required autofocus>
     
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top:30px;margin-bottom:30px">
                                <label for="channel_name" class="col-md-4 col-form-label text-md-right">{{ __('Channel name') }}</label>
    
                                <div class="col-md-6">
                                    <input id="channel_name" type="text" class="form-control" name="channel_name" value="{{ old('channel_name') }}"  v-model="form.channel_name" required autofocus>
    
                                 
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top:30px;margin-bottom:30px">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"  v-model="form.email" value="{{ old('email') }}" required>
    
                             
                                </div>
                            </div>
    
                            <div class="form-group row" style="margin-top:30px;margin-bottom:30px">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  v-model="form.password" required>
    
                                  
                                </div>
                            </div>
    
                            <div class="form-group row" style="margin-top:30px;margin-bottom:30px">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password_confirmation" type="password" class="form-control" 
                                    v-model="form.password_confirmation"
                                    name="password_confirmation" required >
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                            <div  v-for="feed in feedback">
                                    <span  style="color:red" v-text="feed" ></span><br>
                            </div>
                        </form>
                    </div>
            
        </modal>
    </register>