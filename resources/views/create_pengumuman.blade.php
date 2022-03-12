
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
        <h1>Form Pengumuman</h1>
        <br>
        <form>
            <div class="form-group">
            <label for="exampleFormControlInput1">Judul</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Judul Pengumuman">
            </div>
        </form>
        <br>
        <form>
            <div class="form-group">
            <label for="exampleFormControlInput1">Pesan</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Pesan Pengumuman">
            </div>
        </form>
        <br>
        <h5>File Surat Rekomendasi</h5>
        <form class="box" method="post" action="" enctype="multipart/form-data">
            <div class="box__input">
                <input class="box__file" type="file" name="files[]" id="file" data-multiple-caption="{count} files selected" multiple />
                <br>
                <br>
            </div>
        </form>
        <button type="button" class="btn btn-primary" style="border-radius: 40px; width:20%;">Post Pengumuman</button>
        <button type="button" class="btn btn-danger" style="border-radius: 40px; width:20%;">Batalkan</button>
    </div>

    <footer class="mt-auto" style="width:100%">
        <div style="width:100%; height: 100px; background-color:#58CCF4; padding:10px; display:flex; overflow:hidden;">
            <img src="img/logo 2.png" alt=5  width="205" height="82" style="margin-left: 50px">
        </div>
    </footer>
    

        
  </body>
</html>
