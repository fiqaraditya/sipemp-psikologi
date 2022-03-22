@extends('layout')

@section('content')
<div class="container" style="margin-top:3%; margin-bottom:5%">
    <div class="row">
        <h1 style="margin-bottom: 1%">Detail Calon Mahasiswa </h1>

        <div class="shadow card" style="margin-top:2%">
            <div class="card-body">
                <div class="row">
                    <h2 style="text-align:center"> {{$calonmahasiswa->name}}</h2>
                    <hr>

                    <h4 style="color:grey"> Informasi Umum </h4>
                    <p> ID Pendaftaran &nbsp;: &nbsp;{{$calonmahasiswa->no_pendaftaran}}</p>
                    <p> Email  &nbsp; : &nbsp;{{$calonmahasiswa->email}} </p>
                    <p> Status Penerimaan &nbsp;:&nbsp; </p>
                    <hr>
                    


                </div>
            </div>
        </div>
        <br>

        <div class="shadow card" style="margin-top:2%">
        <a class="card-body" style="text-decoration:none" href="{{route('page_psikotest')}}">
            <div class="row">
                <div class="col-1">
                    <img src="img/doc.png" width="45" height="45">
                </div>


                <div class="col-9">
                    <h4 style="color:grey; padding:5px"> Hasil Psikotest </h4>
                    @if (is_null($calonmahasiswa-> file_psikotest_path ))
                    <br>
                    @else
                    <a href="{{url('/download-psikotest',$calonmahasiswa->id)}}">Download Dokumen</a>
                    @endif

                </div>
                <div class="col-1">
                    <div>
                   
                    </div>
                    <div>
                    <img src="img/download.png" width="18" height="18"> 
                    </div>
                       
                    
                </div>

            </div>
            <div class="row">
                </h5>
            </div>
        </a>
    </div>

    <div class="shadow card" style="margin-top:2%">
        <a class="card-body" style="text-decoration:none" href="{{route('page_psikotest')}}">
            <div class="row">
                <div class="col-1">
                    <img src="img/doc.png" width="45" height="45">
                </div>


                <div class="col-9">
                    <h4 style="color:grey; padding:5px"> Surat Rekomendasi </h4>
                </div>
                <div class="col-1">
                    <div>
                      
                    <img src="img/download.png" width="18" height="18">
                    </div>
                </div>

            </div>
            <div class="row">
                </h5>
            </div>
        </a>
    </div>

    <div class="shadow card" style="margin-top:2%">
        <a class="card-body" style="text-decoration:none" href="{{route('page_psikotest')}}">
            <div class="row">
                <div class="col-1">
                    <img src="img/doc.png" width="45" height="45">
                </div>


                <div class="col-9">
                    <h4 style="color:grey; padding:5px"> Lembar Kehidupan </h4>
                </div>
                <div class="col-1">
                    <div>
                    <img src="img/download.png" width="18" height="18">
                    </div>
                       
                    </div>
                </div>

            </div>
            <div class="row">
                </h5>
            </div>
        </a>
    </div>

    
    </div>

</div>

@endsection
