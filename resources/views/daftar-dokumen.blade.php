@extends('layout')

@section('content')
<div class="container" style="margin-top:3%; margin-bottom:5%">
    <h1 style="margin-bottom: 1%">List Template</h1>
    @if ($template->template_lk_path == NULL)
    <div class="shadow card" style="margin-top:2%">
        <a class="card-body" style="text-decoration:none" href="{{route('page_template_lk')}}">
            <div class="row">
                <div class="col-9">
                    <h3 style="color:grey; padding:5px"> Template lembar Kehidupan </h3>
                </div>
                <div class="col">
                    <div
                        style="width:200px;height:40px; background-color:#C4C4C4; border-radius:20px; padding:8px; font-size:10; color:black;text-align:center; float:right;">
                        <h6>Belum Ada Template
                        </h6>
                    </div>
                </div>

            </div>
            <div class="row">
                <h5 style="color:grey; padding:15px"> Kamu belum upload Template lembar Kehidupan. Yuk, segera upload!</h5>
                </h5>
            </div>
        </a>
    </div>  
    @else
    <div class="shadow card" style="margin-top:2%">
        <div class="card-body" style="text-decoration:none" >
            <div class="row">
                <div class="col-9">
                    <h3 style="color:grey; padding:5px"> Template lembar Kehidupan</h3>
                </div>
                <div class="col">
                    <div
                        style="width:130px;height:40px; background-color:green; border-radius:20px; padding:8px; font-size:10; color:white;text-align:center;float:right;">
                        <h6>Selesai
                        </h6>
                        <br>
                        <a class="btn btn-primary" href="{{url('/download-template-lk')}}">Download</a>
                    </div>
                </div>

            </div>
            <div class="row">
                <h5 style="color:grey; padding:15px;width:80%"> Yay, kamu telah berhasil upload template lembar kehidupan !</h5>
                </h5>
            </div>
            <div class="col-1">
                    <a class="btn btn-warning" style=" border:0" href="{{route('page_template_lk')}}" > Ubah file</a>
                </div>
        </div>
    </div>
    @endif

    


    @if ($template->template_rekomendasi_path == NULL)
    <div class="shadow card" style="margin-top:2%">
        <a class="card-body" style="text-decoration:none" href="{{route('page_template_rekomendasi')}}">
            <div class="row">
                <div class="col-9">
                    <h3 style="color:grey; padding:5px"> Template Berkas Rekomendasi </h3>
                </div>
                <div class="col">
                    <div
                        style="width:200px;height:40px; background-color:#C4C4C4; border-radius:20px; padding:8px; font-size:10; color:black;text-align:center;float:right;">
                        <h6>Belum Ada Template
                        </h6>
                    </div>
                </div>

            </div>
            <div class="row">
                <h5 style="color:grey; padding:15px"> Kamu belum upload Template Berkas Rekomendasi. Yuk, segera upload!</h5>
                </h5>
            </div>
        </a>
    </div>  
    @else
    <div class="shadow card" style="margin-top:2%">
        <div class="card-body" style="text-decoration:none" >
            <div class="row">
                <div class="col-9">
                    <h3 style="color:grey; padding:5px"> Template Berkas Rekomendasi</h3>
                </div>
                <div class="col">
                    <div
                        style="width:130px;height:40px; background-color:green; border-radius:20px; padding:8px; font-size:10; color:white;text-align:center;float:right">
                        <h6>Selesai
                        </h6>
                        <br>
                        <a class="btn btn-primary" href="{{url('/download-template-rekomendasi')}}">Download</a>
                    </div>
                </div>

            </div>
            <div class="row">
                <h5 style="color:grey; padding:15px; width:80%"> Yay, kamu telah berhasil upload template berkas rekomendasi !</h5>
                </h5>
            </div>
            <div class="col-1">
                    <a class="btn btn-warning" style="border:0" href="{{route('page_template_rekomendasi')}}" > Ubah file
                    </a>
                </div>
        </div>
    </div>
    @endif
    
    
    <br>

    @include('sweetalert::alert')
</div>
@endsection
