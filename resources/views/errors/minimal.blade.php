<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>


        <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/navbar-fixed/">

        <!-- Bootstrap core CSS -->
        <link href="{{asset('front/css/bootstrap.min.css')}}" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <!-- Custom styles for this template -->
        <link href="navbar-top-fixed.css" rel="stylesheet">

        <style>
            .error-image{
                background-image: url({{url('img/bg-404.png')}});
                background-size: auto;
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 25%;
                /* width: 100%;
                height: 100%; */
            }
            .button {
                background-color: #FFEEEE; 
                color: #000000;
                border: none;
                padding: 20px;
                text-align: center;
                display: inline-block;
                font-size: 16px;
                margin: 4px 2px;
                cursor: pointer;
                border-radius: 12px;
                display: block;
                margin-left: auto;
                margin-right: auto;
                font-weight: bold;
                border: 2px solid black;
            }
        </style>
        
    </head>
    <body class="antialiased">

        <h1 style="text-align: center; font-family: Roboto; font-size: 64px; font-weight: bold;"> @yield('code') <br> Oops!</h1>
        <p style="text-align: center; font-family: Roboto; font-size: 24px; font-style: normal;">@yield('message')</p>
        
        <img class="error-image" src="{{ URL::to('/img/img-404.png') }}">

        <br><br>
        <div>
            <button class="button" type="button" onclick="window.location='{{ url("/") }}'"><img src="{{ URL::to('/img/Arrow-28.png') }}" width="28px" style="margin-right: 10px; margin-bottom: -6px">Menuju Beranda</button>
        </div>
        
        
        <footer class="mt-auto" style="width:99%; position: absolute; bottom:0; margin-left: -10px;">
            <div style="width:100%; height: 100px; background-color:#58CCF4; padding:10px; display:flex; overflow:hidden; ">
                <img src="{{ URL::to('/img/logo 2.png') }}" alt=5 width="205" height="82" style="margin-left: 50px">
            </div>
        </footer>
    </body>
</html>

