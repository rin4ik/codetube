@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Search for "{{Request::get('q')}}"</div>

                <div class="card-body">
                      @if($channels->count())
                      
                        @foreach($channels as $channel)
                        <div class="bg-light p-3 mb-4 "  style="border:1px solid #e0e0e0; border-radius:5px;">
                        <div class="media">
                            <div class="media-left">
                                <a href="/channel/{{$channel->slug}}">
                                <img src="{{$channel->getImage()}}" class="media-object" alt="">
                                </a>
                            </div>
                            <div class="media-body">
                                <a href="/channel/{{$channel->slug}}" class="media-heading">{{$channel->name}}</a> 
                            </div>
                        </div>
                    </div>
                    
                        @endforeach
                      @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
