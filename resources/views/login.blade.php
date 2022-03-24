<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Login SIPeMP</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/navbar-fixed/">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('front/css/bootstrap.min.css')}}" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="navbar-top-fixed.css" rel="stylesheet">
    <style>
        body {
            background-image: linear-gradient(90deg, white 50%, #58CCF4 50%);
        }

        card-login {
            position: absolute;
            left: 30.49%;
            right: 32.08%;
            top: 11.89%;
            bottom: 11.56%;
            filter: drop-shadow(0px 4px 35px rgba(0, 0, 0, 0.08));
        }

    </style>

</head>

<body>
    <nav>
        <a class="navbar-brand" href="#"> <img src="img/logo.png" alt=5 width="290" height="115"> </a>
    </nav>
    <div class="container-fluid" style="margin-top:2%;">
        @include('sweetalert::alert')
        <div class="d-flex flex-row" style="margin-left:30px display:flex">
            <div style="margin-top:20px">
                <img src="img/icon1.png" width="400" height="400">
            </div>

            <div class=" shadow card card-login" style="width: 40rem;border-radius: 10%;height:540px;border:0px">
                <div class="card-body" style="margin-top: 5%;">
                    @if (session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        {{ session('loginError')}}

                    </div>

                    @endif
                    <h5 class="card-title">Selamat Datang di SIPeMP Psikologi UI </h5>
                    <h1 class="card-text">Sign In</h1>
                    <form action="/login" method="post" style="margin-top:5%">
                        @csrf
                        <h5>Email</h5>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="name@example.com" autofocus required>
                            <label for="email">Masukkan email kamu disini</label>
                        </div>
                        <br>
                        <h5>Password</h5>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <label for="password">Masukkan password kamu disini</label>
                        </div>
                        <br>
                        <div class="d-grid">
                            <button class="btn btn-login text-uppercase fw-bold"
                                style="background-color:#E48700; color:white" type="submit">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
            <div style="width:350px;">
                <img src="img/icon2.png" width="343" height="580">
            </div>
        </div>
    </div>
</body>

</html>
