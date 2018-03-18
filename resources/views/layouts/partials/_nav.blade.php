<nav class="navbar navbar-expand-lg navbar-dark stylish-color-dark" style="padding-top:3px;padding-bottom:3px;">
    <div class="container">
        <a class="navbar-brand " href="/"><img class="img-fluid" src="{{asset('images/logo1.png')}}" alt=""   >
            <img class="img-fluid" src="{{asset('images/logo3.png')}}" width="20px" height="20px" alt=""  style="margin-left:-7px; margin-top:2px "  >
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li>
                <a class="nav-link"  @click="$modal.show('login')">{{ __('LOGIN') }}</a>
                    {{--  //<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>  --}}
                </li>
                <li>
                    <a class="nav-link"   @click="$modal.show('register')">{{ __('REGISTER') }}</a>
                </li>
                @else
                <a class="nav-link" href="/upload">Upload</a>
                
                <li class="nav-item dropdown">

                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                        <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('/videos')}}">Your videos</a>
                        <a class="dropdown-item" href="{{url('/channel/'.$channel->slug)}}">Your channel</a>
                        <a class="dropdown-item" href="{{url('/channel/'.$channel->slug.'/edit')}}">Channel settings</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>