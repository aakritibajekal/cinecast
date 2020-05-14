<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Free App for Movie lovers! Always loved talking all things movies? Register now!">
        <meta name="keywords" content="Movie buff, movie lovers, movie ideas, movie discussion">
        <link rel="icon" src="{{URL('/images/cinecast.png')}}" type="png" sizes="16x16">
        <title>CineCast</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
            html, body {
                background-color: #D0DFFC;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .m-b-md {
                margin-bottom: 30px;
            }
            .hero {
	            width: 100%;
                padding-bottom: 50px;
            }
            .specials section {
	            display: inline-block;
	            width: 250px;
	            padding: 15px;
            }
            .section1 {
                width: 250px;
                padding: 20px;
            }
            .section2 {
                width: 250px;
                padding: 20px;
            }
            .section3 {
                width: 250px;
                padding: 20px;
            }
            .fa {
                padding: 20px;
                font-size: 30px;
                width: 50px;
                text-align: center;
                text-decoration: none;
                margin: 5px 2px;
                }

            .fa:hover {
                opacity: 0.7;
                }

            .fa-facebook {
                background: #333333;
                color: white;
                }

            .fa-twitter {
                background: #333333;
                color: white;
                }

            .fa-linkedin {
                background: #333333;
                color: white;
                }
            footer {
                align-items: center;
                text-align: center;
                background: #D0DFFC;

                }
            .title {
                text-align: left
            }
            .what {
                padding: 50px;
                font-size: 20px;
            }
            .right {
                display: inline-block;
                width: 500px;
                padding: 20px;
            }

            
        </style>
         
    </head>
    <body>
    @extends('marketinglayout')
        
            @if (Route::has('login'))
            
                <div class="top-right links">
                    @auth
                       
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                   <h1 class="title"> CineCast </h1>

            <div>
            <img class="hero" src="{{URL('/images/hero.jpg')}}">
            </div>
            <div class="specials">
	        <h2>Why Join CineCast?</h2>
	        <section>
		    <h3 class="specials">
			Free Subscriptions
		    </h3>
		    <img class="section1" src="{{URL('/images/section1.jpg')}}">
	        </section>
	        <section>
		    <h3 class="specials">
			Premium Discussion Panels
		    </h3>
		    <img class="section2" src="{{URL('/images/section2.jpg')}}">
	        </section>
	        <section>
		    <h3 class="specials">
			Free Membership
		    </h3>
		    <img class="section3" src="{{URL('/images/section3.jpg')}}">
	        </section>
            </div>
            </div>
            <div class="what">
            <p>
            Are all your discussions about Movies and TV Series?
            <ul>
            <li>
                Do you love watching movies and TV and feel you want more suggestions?
            </li>
            <li>
                Would you like watching a movie for the 15th time and talk about the plot or drops?
            </li>
            <li>
                Would you like to understand what that movie was all about?
            </li>
            </ul>
            If you answered yes to any or all of the above questions, this app is for you. We carefully filter to make sure there is no spamming or any non entertainment related posts. Pure movies, TV and Drama.</p>
            </div>
            <img class="right" src="{{URL('/images/what.jpg')}}">
        </div>
        <br>
    </body>
    <footer class="welcome-footer">
    <a href="#" class="fa fa-facebook"></a>
    <a href="#" class="fa fa-twitter"></a>
    <a href="#" class="fa fa-linkedin"></a>
    <p>CineCast &copy; Copyright 2020</p>
    </footer>                
</html>
