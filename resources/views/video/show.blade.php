@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
          
           @can('update', $video)
           <div class="alert alert-danger">
                Your video currently private. Only you can see it.
            </div>
           @endcan
           
           @if($video->isProcessed() && $video->canBeAccessed(Auth::user()) )
            show video player
           @endif
           
           <div class="card">

               <div class="card-body">
                   <h4>{{$video->title}}</h4>
                   <div class="pull-right">
                       Video views
                   </div>
                   <div class="media ">
                       <div class="media-left ">
                           <a href="/channel/{{$video->channel->slug}}" c>
                               <img src="{{$video->channel->getImage()}}" alt="{{$video->channel->name}}"> </a>
                       </div>
                       <div class="media-body">
                           <a href="/channel/{{$video->channel->slug}}" class="media-heading">{{$video->channel->name}}</a>
                           Subscribe
                       </div>
                   </div>
               </div>

           </div>
           <br> @if($video->description)
           <div class="card card-default">

               <div class="card-body">
                   {!! nl2br(e($video->description)) !!}
               </div>
           </div>
<br>
           @endif
           <div class="card card-default">
               <div class="card-body"> 
                   @if($video->commentsAllowed())
                   Comments
                   @else
                   Comments are disabled for this video
                   @endif
               </div>
           </div>
          
        </div>
    </div>
    @endsection