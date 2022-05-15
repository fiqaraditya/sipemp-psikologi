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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js"
        integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>

</head>
<style>
   tab3  { position:absolute;left:80px; }
   tab2  { position:absolute;left:30px; }
   tab1  { position:absolute;left:60px; }
   tab0  { position:absolute;left:55px; }

</style>

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
            @auth
            @php
                $currentURL = url()->current();
            @endphp
            @if (str_contains($currentURL,"pewawancara"))
                <style>
                    #pewawancara{
                        font-weight: bold;
                    }
                </style>
            @elseif (str_contains($currentURL,"pengumuman"))
            <style>
                #pengumuman{
                    font-weight: bold;
                }
            </style>
            @elseif (str_contains($currentURL,"admin"))
            <style>
                #admin{
                    font-weight: bold;
                }
            </style>
            @elseif (str_contains($currentURL,"mahasiswa"))
            <style>
                #calonmahasiswa{
                    font-weight: bold;
                }
            </style>
            @elseif (str_contains($currentURL,"wawancara")||str_contains($currentURL,"jadwal"))
            <style>
                #wawancara{
                    font-weight: bold;
                }
            </style>
            @elseif (str_contains($currentURL,"berkas")||str_contains($currentURL,"file-1")||str_contains($currentURL,"file-2"))
            <style>
                #berkas{
                    font-weight: bold;
                }
            </style>
            @elseif (str_contains($currentURL,"file-3"))
            <style></style>
            @else
            <style>
                #beranda{
                    font-weight: bold;
                }
            </style>
            @endif
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-left:200px" class="mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/" id="beranda">Beranda</a> 
                    </li>
                    @if (auth()->user()->role=="admin")
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" id="pengumuman"
                            href="{{route('daftar_pengumuman')}}">Pengumuman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" id="dokumen"
                            href="{{route('daftar_mahasiswa')}}">Dokumen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" id="admin" href="{{route('daftar_admin')}}">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" id="pewawancara"
                            href="{{route('daftar_pewawancara')}}">Pewawancara</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" id="calonmahasiswa"
                            href="{{route('daftar_mahasiswa')}}">Calon Mahasiswa</a>
                    </li>
                    @endif
                    @if (auth()->user()->role=="calon mahasiswa")
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" id="berkas"
                            href="{{route('kelengkapan_berkas')}}">Kelengkapan Berkas</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" id="wawancara"
                            href="{{route('daftar_jadwal_wawancara')}}">Wawancara</a>
                    </li>
                </ul>
            </div>
            @else
            @endauth
        </div>
        <div style="margin-right:20px">
            @auth
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-right:400px">
                <li class="nav-item" style="width:100%; margin-top:3%">
                    <b>{{ auth()->user()->name }}</b>
                </li>
                <li class="nav-item" style="margin-left:10%">
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary"
                            style="background-color:#E48700; border:0px; width:80px;margin-right:50px">Keluar</button>
                    </form>
                </li>
            </ul>
            @else
            <a type="button" href="/login" class="btn btn-primary"
                style="background-color:#E48700; border:0px; width:80px;margin-right:50px">Masuk</a>
            @endauth

        </div>
    </nav>
    <hr>
    @yield('content')

    {{-- <footer class="footer">
        <div style="width:100%; height: 100px; background-color:#58CCF4; padding:10px; display:flex; overflow:hidden; ">
            <img src="img/logo 2.png" alt=5 width="205" height="82" style="margin-left: 50px">
        </div>
    </footer> --}}

</body>

</html>

@stack('scripts')
