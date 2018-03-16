@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit video "{{$video->title}}"</div>

                <div class="card-body">
                    <form action="/videos/{{$video->uid}}" method="post" >
                   
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" 
                            value="{{old('title')? old('title'): $video->title}}">
                            @if($errors->has('title'))
                                <div class="danger">
                                    {{$errors->first('title')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                                <label for="description">Descrition</label>
                                <textarea name="description" id="description" class="form-control" >{{old('description')? old('description'): $video->description}}
                                </textarea>
                                @if($errors->has('description'))
                                    <div class="danger">
                                        {{$errors->first('description')}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                              <label for="visibility">Visibility</label>
                                    <select name="visibility" id="visibility" class="form-control"  >
                                        @foreach(['public','unlisted','private'] as $visibility)
                                        <option value="{{$visibility}}" {{$video->visibility == $visibility ? 'selected="selected"' :''}}>{{ucfirst($visibility)}}</option>
                                        @endforeach
                                    </select>
                            
                                </div>
                                <div class="form-group">
                                    <label for="allow_votes">
                                        <input type="checkbox" name="allow_votes" id="allow_votes" {{$video->votesAllowed()? 'checked="checked"':''}}> Allow votes
                                    </label>
                                </div>
                                <div class="form-group">
                                        <label for="allow_comments">
                                            <input type="checkbox" name="allow_comments" id="allow_comments" {{$video->commentsAllowed()? 'checked="checked"':''}}> Allow comments
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                        @csrf
                    @method('put')
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
