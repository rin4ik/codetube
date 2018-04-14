@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
          
           @if($video->isPrivate() && auth()->check() && $video->ownedByUser(auth()->user()))
           <div class="alert alert-danger">
                Your video currently private. Only you can see it.
            </div>
           @endif
           
           @if($video->isProcessed() && $video->canBeAccessed(Auth::user()) )
              <video-player video-uid="{{$video->uid}}" video-url="{{$video->getStreamUrl()}}" thumbnail-url="{{$video->getThumbnail()}}"></video-player>
           @endif
           
           @if(!$video->isProcessed())
               <div class="video-placeholder">
                   <div class="video-placeholder__header">
                       The video is processing. Come back later.
                   </div>
                </div>      
           @elseif(!$video->canBeAccessed(auth()->user()))
           <div class="video-placeholder">
                <div class="video-placeholder__header">
                        The video is private.
                  </div>
             </div>
           @endif
           <div class="card">

               <div class="card-body">
                   <h4>{{$video->title}}</h4>
                   <div class="pull-right">
                       <div class="video__views">
                            {{$video->viewCount()}} {{str_plural('view',$video->viewCount())}}
                            <video-voting video-uid="{{$video->uid}}"></video-voting>
                       </div>
                   </div>
                   <div class="media ">
                       <div class="media-left ">
                           <a href="/channel/{{$video->channel->slug}}" c>
                               <img src="{{$video->channel->getImage()}}" alt="{{$video->channel->name}}"> </a>
                       </div>
                       <div class="media-body">
                           <a href="/channel/{{$video->channel->slug}}" class="media-heading">{{$video->channel->name}}</a>
                           Subscribe
                           <br> @if($video->description)
                          
                                   {!! nl2br(e($video->description)) !!}
                               
                <br>
                           @endif
                       </div>
                   </div>
               </div>

           </div>
          <br>
           <div class="card card-default">
               <div class="card-body"> 
                   @if($video->commentsAllowed())
                 <video-comments video-uid="{{$video->uid}}"></video-comments>
                   @else
                   Comments are disabled for this video
                   @endif
               </div>
           </div>
          
        </div>
    </div>
    @endsection