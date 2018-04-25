@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your subscriptions</div>

                <div class="card-body">
                   @if($subscriptionVideos->count())
                        @foreach($subscriptionVideos as $video)
                       <div style="border:1px solid #cacdd0;   border-radius:5px;" >
                            @include('video.partials._video_result' )
                    </div>    
                        @endforeach
                   @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
