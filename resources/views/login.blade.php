
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
    <link href="{{asset('front/css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="navbar-top-fixed.css" rel="stylesheet">
        <style>
            body{
                background-image: linear-gradient(90deg, white 50%, #58CCF4 50%);
            }
            card-login{
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
    <div class="container-fluid">
        <a class="navbar-brand href="#"> <img src="img/logo.png" alt=5  width="290" height="115"> </a>
    </div>

    <div class="d-flex flex-row" style="margin-left:30px display:flex">
        <div style="margin-top:20px">
        <img src="img/icon1.png" width="400" height="400">
        </div>
      
        <div class="card card-login" style="width: 40rem;">
            <div class="card-body">
                <h5 class="card-title">Selamat Datang di SIPeMP Psikologi UI </h5>
                <h1 class="card-text">Sign In</h1>
                <form>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="d-grid">
                    <button class="btn btn-login text-uppercase fw-bold" style="background-color:#E48700; color:white" type="submit">Masuk</button>
                </div>
                </form>
            </div>
        </div>
        <div style="width:350px;border:1px solid black;">
        <img src="img/icon2.png" width="343" height="588">
        </div>
    </div>

   
        
  </body>
</html>
