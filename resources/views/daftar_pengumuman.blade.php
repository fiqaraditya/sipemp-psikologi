
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
    <link href="{{asset('front/css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="navbar-top-fixed.css" rel="stylesheet">
  </head>
  <body class="d-flex flex-column min-vh-100">
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#" style="margin-left: 50px"> <img src="img/logo.png" alt=5  width="205px" height="82px"> </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-left:200px" class="mx-auto" >
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Beranda</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#"><b><u>Pengumuman</u></b></a>
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
        <a type="button" href="/login" class="btn btn-primary" style="background-color:#E48700; border:0px; width:80px;margin-right:50px">Masuk</a>
    </div>
    </nav>
    <div style="width:1440px;border:2px solid #C9C1C1;width:100%"></div>

    <div class="container" style="margin-top:3%; margin-bottom:5%">
        <div class="row">
            <h1 style="margin-bottom: 1%">Daftar Pengumuman</h1>
            <br>
            <button type="button" class="btn btn-primary" style="border-radius: 40px; width:20%;">Buat Pengumuman</button>
        
            <div class="shadow card" style="margin-top:2%">
                <div class="card-body">
                    <div class="row">
                        <div class="col-1">
                            <img src="img/ava.png" width="100" height="100">
                        </div>
                        <div class="col-9">
                            <h3>Judul Pengumuman</h3>
                            <h5>by Author - Day, DD MM YYYY, AA.BB AM/PM </h5>
                        </div>
                        <div class="col-1">
                            <h4 style="font-weight: normal">Ubah</h4>
                        </div>
                        <div class="col-1">
                            <h4 style="font-weight: normal">Hapus</h4>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <h5 style="font-weight: normal">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                            <br>
                            <br>
                            The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-auto" style="width:100%">
        <div style="width:100%; height: 100px; background-color:#58CCF4; padding:10px; display:flex; overflow:hidden;">
            <img src="img/logo 2.png" alt=5  width="205" height="82" style="margin-left: 50px">
        </div>
    </footer>
    

        
  </body>
</html>
