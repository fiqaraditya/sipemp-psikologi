@extends('layout')

@section('content')
<div class="container" style="margin-top:3%; margin-bottom:5%">
    <h1 style="margin-bottom: 1%">Kelengkapan Berkas</h1>
    @if ($document->where('mahasiswa_id', auth()->user()->id)->first()->file_psikotest_path == NULL)
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
                            style="width:140px;height:40px; background-color:#C4C4C4; border-radius:20px; padding:8px; font-size:10; color:black;text-align:center">
                            <h6>Belum Lengkap
                            </h6>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <h5 style="color:grey; padding:15px"> Kamu belum upload berkas Hasil Psikotest. Yuk, segera upload!</h5>
                    </h5>
                </div>
            </a>
        </div>  
    @else
    <div class="shadow card" style="margin-top:2%">
        <div class="card-body" style="text-decoration:none" >
            <div class="row">
                <div class="col-1">
                    <img src="img/doc.png" width="45" height="45">
                </div>


                <div class="col-9">
                    <h3 style="color:grey; padding:5px"> Hasil Psikotest </h3>
                </div>
                <div class="col-1">
                    <div
                        style="width:130px;height:40px; background-color:green; border-radius:20px; padding:8px; font-size:10; color:white;text-align:center;">
                        <h6>Selesai
                        </h6>
                        <br>
                        <a class="btn btn-primary" href="{{url('/download-psikotest',auth()->user()->id)}}">Download Hasil Psikotest</a>
                    </div>
                </div>

            </div>
            <div class="row">
                <h5 style="color:grey; padding:15px"> Yay, kamu telah berhasil upload berkas hasil psikotest!</h5>
                </h5>
            </div>
            <div class="col-1">
                    <a class="btn btn-primary" style="background-color:grey; border:0" href="{{route('page_psikotest')}}" > Ubah file
                    </a>
                </div>
        </div>
    </div>
    @endif

    @if ($recommendation->count() != 2 )

        <div class="shadow card" style="margin-top:2%">
            <a class="card-body" style="text-decoration:none" href="{{route('page_email')}}">
                <div class="row">
                    <div class="col-1">
                        <img src="img/doc.png" width="45" height="45">
                    </div>


                    <div class="col-9">
                        <h3 style="color:grey; padding:5px"> Email Pemberi Rekomendasi </h3>
                    </div>
                    <div class="col-1">
                        <div
                            style="width:140px;height:40px; background-color:#C4C4C4; border-radius:20px; padding:8px; font-size:10; color:black;text-align:center">
                            <h6>Belum Lengkap
                            </h6>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <h5 style="color:grey; padding:15px"> Email pemberi rekomendasi kamu belum diisi. Yuk, segera isi!</h5>
                    </h5>
                </div>
                
            </a>
        </div>  
    @else
    <div class="shadow card" style="margin-top:2%">
        <a class="card-body" style="text-decoration:none" href="{{route('page_email')}}">
            <div class="row">
                <div class="col-1">
                    <img src="img/doc.png" width="45" height="45">
                </div>


                <div class="col-9">
                    <h3 style="color:grey; padding:5px"> Email Pemberi Rekomendasi </h3>
                </div>
                <div class="col-1">
                    <div
                        style="width:130px;height:40px; background-color:green; border-radius:20px; padding:8px; font-size:10; color:white;text-align:center;">
                        <h6>Selesai
                        </h6>
                    </div>
                </div>
                

            </div>
            <div class="row">
                <h5 style="color:grey; padding:15px"> Surat rekomendasimu berhasil terkirim </h5>
                </h5>
            </div>
           
        </a>
    </div>
    @endif

    @if ($document->where('mahasiswa_id', auth()->user()->id)->first()->file_lk_path == NULL)
        <div class="shadow card" style="margin-top:2%">
            <a class="card-body" style="text-decoration:none" href="{{route('page_lk')}}">
                <div class="row">
                    <div class="col-1">
                        <img src="img/doc.png" width="45" height="45">
                    </div>


                    <div class="col-9">
                        <h3 style="color:grey; padding:5px"> Lingkungan Kehidupan </h3>
                    </div>
                    <div class="col-1">
                        <div
                            style="width:140px;height:40px; background-color:#C4C4C4; border-radius:20px; padding:8px; font-size:10; color:black;text-align:center;">
                            <h6>Belum Lengkap
                            </h6>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <h5 style="color:grey; padding:15px"> Kamu belum upload berkas Lembar Kehidupan. Yuk, segera upload!</h5>
                    </h5>
                </div>
            </a>
        </div>  
    @else
    <div class="shadow card" style="margin-top:2%">
        <div class="card-body" style="text-decoration:none" href="{{route('page_lk')}}">
            <div class="row">
                <div class="col-1">
                    <img src="img/doc.png" width="45" height="45">
                </div>
                


                <div class="col-9">
                    <h3 style="color:grey; padding:5px"> Lingkungan Kehidupan</h3>
                    
                </div>

                <div class="col-1">
               
                    <div
                        style="width:130px;height:40px; background-color:green; border-radius:20px; padding:8px; font-size:10; color:white;text-align:center; ">
                        <h6>Selesai
                        </h6> <br>
                        <a class="btn btn-primary" href="{{url('/download-lk',auth()->user()->id)}}">Download Lembar Kehidupan</a>
                    </div>
                    
                </div>

            </div>
            
            <div class="row">
                
                <h5 style="color:grey; padding:15px"> Yay, kamu telah berhasil upload berkas Lingkungan Kehidupan!</h5>
                </h5>
            </div>

            <div class="col-1">
                    <a class="btn btn-primary" style="background-color:grey; border:0" href="{{route('page_lk')}}" > Ubah file
                    </a>
                </div>
                <br>
</div>
    </div>
    @endif

    
    <br>

    @include('sweetalert::alert')
</div>
@endsection
