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
    <style>
    .footer {
        align-items: center;
        text-align: center;
        background: #D0DFFC;
        }
    </style>

    <body>
        @include('partials.navigation')
        <h1>
            @yield('title')
        </h1>

        @yield('js')

        @yield('content')
      
    </body>
    <footer class="welcome-footer">
    <a href="#" class="fa fa-facebook"></a>
    <a href="#" class="fa fa-twitter"></a>
    <a href="#" class="fa fa-linkedin"></a>
    <p>CineCast &copy; Copyright 2020</p>
    </footer>

</html>