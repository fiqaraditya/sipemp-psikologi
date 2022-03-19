@extends('layout')

@section('content')
<div class="container" style="margin-top:3%; margin-bottom:5%">
    <h1 style="margin-bottom: 1%">Kelengkapan Berkas</h1>
    <div class="shadow card" style="margin-top:2%">
        <a class="card-body" style="text-decoration:none" href="{{route('page_psikotest')}}">
            <div class="row">
                <div class="col-1">
                    <img src="img/doc.png" width="45" height="45">
                </div>


                <div class="col-9">
                    <h3 style="color:grey; padding:5px"> Hasil Psikotest </h3>
                </div>
                <div class="col-1">
                    <div
                        style="width:130px;height:40px; background-color:#C4C4C4; border-radius:20px; padding:8px; font-size:10; color:black">
                        <h8>Belum Lengkap
                        </h8>
                    </div>
                </div>

            </div>
            <div class="row">
                <h5 style="color:grey; padding:15px"> Kamu belum upload berkas Hasil Psikotest. Yuk, segera upload!</h5>
                </h5>
            </div>
        </a>
    </div>
    <br>
    <div class="shadow card" style="margin-top:2%">
        <a class="card-body" style="text-decoration:none" href="{{route('page_lk')}}">
            <div class="row">
                <div class="col-1">
                    <img src="img/doc.png" width="45" height="45">
                </div>


                <div class="col-9">
                    <h3 style="color:grey; padding:5px"> Email Pemberi Rekomendasi </h3>
                </div>
                <div class="col-1">
                    <div
                        style="width:130px;height:40px; background-color:#C4C4C4; border-radius:20px; padding:8px; font-size:10; color:black">
                        <h8>Belum Lengkap
                        </h8>
                    </div>
                </div>

            </div>
            <div class="row">
                <h5 style="color:grey; padding:15px"> Email pemberi rekomendasi kamu belum diisi. Yuk, segera isi! </h5>
                </h5>
            </div>
        </a>
    </div>
    <br>
    <div class="shadow card" style="margin-top:2%">
        <a class="card-body" style="text-decoration:none" href="{{route('page_rekomendasi')}}">
            <div class="row">
                <div class="col-1">
                    <img src="img/doc.png" width="45" height="45">
                </div>

                <div class="col-9">
                    <h3 style="color:grey; padding:5px"> Lembar Kehidupan</h3>
                </div>
                <div class="col-1">
                    <div
                        style="width:130px;height:40px; background-color:#C4C4C4; border-radius:20px; padding:8px; font-size:10; color:black">
                        <h8>Belum Lengkap
                        </h8>
                    </div>
                </div>

            </div>
            <div class="row">
                <h5 style="color:grey; padding:15px"> Kamu belum upload berkas Lembar Kehidupan. Yuk, segera upload!</h5>
                </h5>
            </div>
        </a>
    </div>
    <br>


</div>
@endsection
