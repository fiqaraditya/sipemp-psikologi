<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>SIPeMP Psikologi UI</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/navbar-fixed/">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('front/css/bootstrap.min.css')}}" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="navbar-top-fixed.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#" style="margin-left: 50px"> <img src="img/logo.png" alt=5 width="205px"
                    height="82px"> </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-left:200px" class="mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"><b><u>Beranda</u></b></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Pengumuman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Wawancara</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Pendaftar</a>
                    </li>
                </ul>
            </div>
        </div>
        <div style="margin-right:20px">
            @auth
            <form action="/logout" method="post">
                @csrf
                <button type="submit" class="btn btn-primary"
                style="background-color:#E48700; border:0px; width:80px;margin-right:50px">Keluar</button>
            </form>
            @else
            <a type="button" href="/login" class="btn btn-primary"
                style="background-color:#E48700; border:0px; width:80px;margin-right:50px">Masuk</a>
            @endauth

        </div>
    </nav> @yield('content')
    <footer class="mt-auto" style="width:100%;">
        <div style="width:100%; height: 100px; background-color:#58CCF4; padding:10px; display:flex; overflow:hidden; ">
            <img src="img/logo 2.png" alt=5 width="205" height="82" style="margin-left: 50px">
        </div>
    </footer>

</body>

</html>
