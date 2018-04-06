<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
        <link rel="icon" type="image/png" href="{{asset('images/logo.png')}}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
<!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script>
        
        window.App={!!json_encode(['csrfToken'=>csrf_token(),
        'url'=>config('app.url'),
        'user'=>Auth::user(),
        'signedIn'=>Auth::check()
        ])!!};
    </script>
    <style>
     
[v-cloak] {
    display: none;
  }
    </style>
</head>
<body> 
  
    <div id="app">
     @include('layouts.partials._nav')

        <main class="py-4">
            @yield('content')
        </main>
        <flash levels="{{session('level')}}" message="{{session('flash')}}"></flash>
        <div v-cloak >
                @include('modals.all')
               
        </div> 
        
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
    
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/js/mdb.min.js"></script>
</body>
</html>
