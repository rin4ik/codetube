@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Videos</div>

                <div class="card-body">
               @forelse($videos as $video)
                <div class="bg-light p-3 mb-4 " style="border:1px solid #e0e0e0; border-radius:5px;"  >
                
                <div class="row" >
                        <div class="col-sm-3 ">
                            <a href="/videos/{{$video->uid}}"><img src="{{$video->getThumbnail()}}" class="img-fluid img-thumbnail" alt="{{$video->title}} thumbnail"></a>  
                        </div>       
                        <div class="col-sm-9">
                             <a href="/videos/{{$video->uid}}">{{$video->title}}</a>                
                        <div class="row">
                            <div class="col-sm-6">
                             <p class="text-muted">
                                @if(!$video->isProcessed())
                                    {{$video->processedPercentage()}}
                                @else 
                                {{$video->created_at->toDateTimeString() }}
                            @endif
                        </p>
                            <form action="/videos/{{$video->uid}}" method="post">
                            <a :video="{{$video}}" @click="$modal.show('edit')"class="btn btn-outline-default btn-sm ">Edit</a>
                            <button class="btn btn-outline-danger btn-sm" type="submit">Delete</button>    
                            @csrf
                                @method('delete')
                        </form>
                            </div>
                            <div class="col-sm-6">
                                @if($video->visibility == 'public')
                                <p style="color:green"> {{ucfirst($video->visibility)}}</p>
                                @elseif($video->visibility == 'private')
                                <p style="color:red"> {{ucfirst($video->visibility)}}</p>    @else
                                <p style="color:#888806"> {{ucfirst($video->visibility)}}</p>                                    
                               @endif         
                            </div>
                        </div> 
                            </div>             
                </div>    

            </div>   
               @empty
                <p>You have no videos</p>
                    @endforelse
               {{$videos->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
