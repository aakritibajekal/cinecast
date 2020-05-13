<!DOCTYPE html>


<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/png" href="{{URL('/images/cinecast.png')}}">
        <title> @yield('title') </title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ asset('js/app.js') }}" type ="text/javascript" defer ></script>
        
    </head>

    <body>
        @include('partials.navigation')
        <h1>
            @yield('title')
        </h1>

        @yield('js')

        @yield('content')
      
    </body>

</html>