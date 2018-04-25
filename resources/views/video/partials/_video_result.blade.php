<div class="row bg-light mt-2 "  style="border:1px solid #e6e9eb;  padding:5px  ">
    <div class="col-sm-3 bg-light"   >
        <a href="/videos/{{$video->uid}}">
            <img src="{{$video->getThumbnail()}}"  class="img-fluid img-thumbnail" alt="{{$video->title}} image">
        </a>
    </div>
    <div class="col-sm-9" >
        <a href="/videos/{{$video->uid}}">{{$video->title}}</a>
        @if($video->description)
            <p>{{$video->description}}</p>
        @endif
        <ul class="list-inline mb-2"  >
            <li  class="list-inline-item mb-4"><a href="/channel/{{$video->channel->slug}}">{{$video->channel->name}}</a></li> <li  class="list-inline-item">{{$video->created_at->diffForHumans()}}</li>
      <li  class="list-inline-item">{{$video->viewCount()}} {{str_plural('view',$video->viewCount())}}</li>
        </ul>
    </div>
</div>