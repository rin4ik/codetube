@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Search for "{{Request::get('q')}}"</div>

                <div class="card-body">
                    @if($channels->count()) @foreach($channels as $channel)
                    <div class="bg-light p-3 mb-4 " style="border:1px solid #e0e0e0; border-radius:5px;">
                        <div class="media">
                            <div class="media-left">
                                <a href="/channel/{{$channel->slug}}">
                                    <img src="{{$channel->getImage()}}" class="media-object" alt="">
                                </a>
                            </div>
                            <div class="media-body">
                                <a href="/channel/{{$channel->slug}}" class="media-heading">{{$channel->name}}</a> 
                             Subscription count 
                            </div>
                        </div>
                    </div>

                    @endforeach @endif
                     
                    @if($videos->count())
                     @foreach($videos as $video)
                    <div class="bg-light p-3 mb-4 " style="border:1px solid #e0e0e0; border-radius:5px;">
                        @include('video.partials._video_result',['video'=>$video])
                    </div>

                    @endforeach 
                    @else
                        <p>No videos found</p>
                    @endif
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection