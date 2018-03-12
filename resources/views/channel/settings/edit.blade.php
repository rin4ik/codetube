@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Channel settings</div>

                <div class="card-body ">
                    <form action="/channel/{{$channel->slug}}/edit" method="post" enctype="multipart/form-data">
                   <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name')?old('name') : $channel->name}}">
                        @if($errors->has('name'))
                            <div class="text-danger">
                                {{$errors->first('name')}}
                            </div>
                        @endif
                   </div>
                   <div class="form-group">
                    <label for="slug">Slug</label>
                 <div class="input-group mb-3">
                    <div class="input-group-prepend">
                     <span class="input-group-text" >http://codecourse.test/channel/</span>
                    </div>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{old('slug')?old('slug') : $channel->slug}}">   

                 </div>
                    @if($errors->has('slug'))
                        <div class="text-danger">
                            {{$errors->first('slug')}}
                        </div>
                    @endif
               </div>
               <div class="form-group">
                    <label for="description">Description</label>
                   <textarea   class="form-control" id="description" name="description" >{{old('description')?old('description') : $channel->description}}</textarea>
                    @if($errors->has('description'))
                        <div class="text-danger">
                            {{$errors->first('description')}}
                        </div>
                    @endif
               </div>
               <div class="form-group">
                <label for="image">Channel image</label><br>
                <input type="file" name="image" id="image">
             
                 </div>
               @csrf
               @method('put')
            <button type="submit" class="btn btn-default">Update</button>
            </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
