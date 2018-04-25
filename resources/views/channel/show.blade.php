@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card"> 

                <div class="card-body">
                    <div class="media">
                        <div class="media-left">
                            <img src="{{$channel->getImage()}}" alt="{{$channel->name}} image" class="media-object">
                        </div>
                        <div class="media-body">
                            {{$channel->name}}
                            <ul class="list-inline">

                                    <li>
                                        <subscribe-button channel-slug="{{$channel->slug}}"></subscribe-button>
                                    </li>
                                    
                            </ul>
                            @if($channel->description)

                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4"> 
    <div class="card-header">Videos</div>
                    <div class="card-body ">
                       
                            @forelse($videos as $video)
                           <div >
                                @include('video.partials._video_result' )
                        </div>    
                        @empty
                        <p>{{$channel->name}} has no videos</p>
                            @endforelse
                          

                    </div>
                    <span  >{{$videos->links()}}</span>  
                </div>
        </div>
    </div>
</div>
@endsection
