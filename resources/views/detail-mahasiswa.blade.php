@extends('layout')

@section('content')
<div class="container" style="margin-top:3%; margin-bottom:5%">
    <div class="row">
        <h1 style="margin-bottom: 1%">Detail Calon Mahasiswa </h1>

        <div class="shadow card" style="margin-top:2%">
            <div class="card-body">
                <div class="row">
                    <h2> {{$calonmahasiswa->name}}</h2>
                    <hr>

                    <h4 style="color:grey; text-align:center"> Informasi Umum </h4>
                    <h6 style="color:grey"> ID Pendaftaran </h6> <br>
                    <h5> {{$calonmahasiswa->no_pendaftaran}}</h5>
                    <h6 style="color:grey"> Email  </h6>
                    <h5>{{$calonmahasiswa->email}}</h5>
                    <h6 style="color:grey"> Status Penerimaan</h6>
                    
                    @if (is_null($calonmahasiswa-> status_penerimaan))
                    <div
                    style="width:200px;height:40px; background-color:grey; border-radius:20px; padding:10px; font-size:6; color:white;text-align:center;">
                    <h5> Belum Ditentukan</h5>
                    </div>
                    @elseif ($calonmahasiswa-> status_penerimaa == "lolos")
                    <div
                    style="width:200px;height:40px; background-color:grey; border-radius:20px; padding:10px; font-size:6; color:white;text-align:center;">
                    <h6> Lolos</h6>
                    </div>
                    @else
                    <div
                    style="width:200px;height:40px; background-color:grey; border-radius:20px; padding:10px; font-size:8; color:white;text-align:center;">
                    <h5> Tidak Lolos </h5>
                    </div>
                    @endif
                    <br> <br>
                    <hr>

                    <h4 style="color:grey;text-align:center"> Berkas </h4>

                    <div style="display:flex">
                    <h5 style="flex-grow: 1;"> Hasil Psikotest </h5>
                    @foreach ($document as $doc)
                    @if($doc->mahasiswa_id == $calonmahasiswa->id)
                    @if (is_null($doc-> file_psikotest_path ))
                    <br>
                    @else
                    <a  class="btn btn-primary" href="{{url('/download-psikotest',$calonmahasiswa->id)}}">Download Hasil Psikotest</a>
                    @endif
                    @endif
                    @endforeach
                    </div>
                    <br>

                    <div style="display:flex">
                    <h5 style="flex-grow: 1;"> Surat Rekomendasi </h5>
                    @foreach ($recommendation as $rec)
                    @if($rec->mahasiswa_key == $calonmahasiswa->no_pendaftaran)
                    <div>
                    <a  class="btn btn-primary"  href="{{url('/download-rekomendasi1',$calonmahasiswa->id)}}">Download Surat Rekomendasi 1 </a> 
                    </div> <br>
                    
                    <a class="btn btn-primary" href="{{url('/download-rekomendasi2',$calonmahasiswa->id)}}">Download Surat Rekomendasi 2 </a>
                    @break
                   
                    @endif
                    @endforeach
                    </div>
                    <br>

                    <div style="display:flex">
                    <h5 style="flex-grow: 1;"> Lembar Kehidupan </h5>
                    @foreach ($document as $doc)
                    @if($doc->mahasiswa_id == $calonmahasiswa->id)
                    @if (is_null($doc-> file_lk_path))
                    <br>
                    @else
                    <a class="btn btn-primary" href="{{url('/download-lk',$calonmahasiswa->id)}}">Download Lembar Kehidupan</a>
                    @endif
                    @endif
                    @endforeach
                    </div>
                    






                </div>
            </div>
        </div>
    </div>

</div>

@endsection
