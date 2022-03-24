@extends('layout')

@section('content')
<div class="container" style="margin-top:3%; margin-bottom:5%">
    <div class="row">
        <h1 style="margin-bottom: 1%">Detail Calon Mahasiswa </h1>

        <div class="shadow card" style="margin-top:2%;margin-bottom:2%">
            <div class="card-body">
                <div class="row">
                    <h2> {{$calonmahasiswa->name}}</h2>
                    <hr>

                    <h4 style="color:grey; text-align:center"> Informasi Umum </h4>
                    <h6 style="color:grey"> ID Pendaftaran : {{$calonmahasiswa->no_pendaftaran}}</h6> <br>
                    <h6 style="color:grey"> Email : {{$calonmahasiswa->email}} </h6>
                    <h6 style="color:grey"> Status Rekomendasi :</h6>
                    <br>
                    @foreach ($document as $doc)
                        @if ($doc->mahasiswa_id == $calonmahasiswa->id)
                            @if (is_null($doc-> status_rekomendasi))
                            <div
                            style="width:200px;height:40px; background-color:grey; border-radius:20px; padding:10px; font-size:6; color:white;text-align:center;">
                            <p> Belum Ditentukan</p>
                            </div>
                            @elseif ($doc-> status_rekomendasi == 1)
                            <div
                            style="width:200px;height:40px; background-color:green; border-radius:20px; padding:10px; font-size:6; color:white;text-align:center;">
                            <h6> Lolos</h6>
                            </div>
                            @else
                            <div
                            style="width:200px;height:40px; background-color:red; border-radius:20px; padding:10px; font-size:8; color:white;text-align:center;">
                            <h5> Tidak Lolos </h5>
                            </div>
                            @endif
                        @endif
                    @endforeach
                    <br> 
                    <br>
                    <hr>

                    <h4 style="color:grey;text-align:center"> Berkas </h4>

                    <div style="display:flex">
                    <h5 style="flex-grow: 1;"> Hasil Psikotest </h5>
                    @foreach ($document as $doc)
                        @if($doc->mahasiswa_id == $calonmahasiswa->id)
                            @if (is_null($doc-> file_psikotest_path ))
                            @else
                            <a  class="btn btn-primary" href="{{url('/download-psikotest',$calonmahasiswa->id)}}" style="width:255px">Download Hasil Psikotest</a>
                            @endif
                        @endif
                    @endforeach
                    </div>
                    <br>
                    
                    <div style="display:flex">
                    <h5 style="flex-grow: 1;"> Surat Rekomendasi </h5>
                    @php
                        $count = 0;
                    @endphp
                    @foreach ($recommendation as $rec)
                        
                            @if($rec->mahasiswa_key == $calonmahasiswa->no_pendaftaran && $rec->file_path != NULL)
                            @php
                                $filename = str_replace('public/recommendation/','',$rec->file_path)
                            @endphp
                            <div style="margin-left: 1%">
                            <a  class="btn btn-primary" style="text-align:justify;width:255px;margin-top:4%" href="{{url('/download-rekomendasi', $filename)}}" >Download Surat Rekomendasi {{++$count}} </a> 
                            </div> 
                        
                            @endif
                        
                    @endforeach
                    </div>
                    <br>

                    <div style="display:flex">
                    <h5 style="flex-grow: 1;"> Lingkungan Kehidupan </h5>
                    @foreach ($document as $doc)
                        @if($doc->mahasiswa_id == $calonmahasiswa->id)
                            @if (is_null($doc-> file_lk_path))
                                <br>
                            @else
                                <a class="btn btn-primary" href="{{url('/download-lk',$calonmahasiswa->id)}}" style="margin-top: 1%; margin-bottom : 1%;width:255px">Download Lembar Kehidupan</a>
                            @endif
                        @endif
                    @endforeach
                    </div>
                
                </div>
            </div>
        </div>
        <br>

        @foreach ($document as $doc)
            @if ($doc->mahasiswa_id == $calonmahasiswa->id)
                @if (is_null($doc-> status_rekomendasi))
                    <a  class="btn btn-success" style="border-radius: 40px; width:20%;margin-right:1%" href="{{url('/terima',$calonmahasiswa->id)}}"> Terima Verifikasi </a>
                    <a  class="btn btn-danger" style="border-radius: 40px; width:20%;" href="{{url('/tolak',$calonmahasiswa->id)}}">Tolak Verifikasi</a> 
                @elseif ($doc-> status_rekomendasi == 1)
                    <a class="btn btn-secondary" style="border-radius: 40px; width:20%;margin-right:1%" href="{{url('/ralat',$calonmahasiswa->id)}}"> Ralat Verifikasi </a>
                    <a class="btn btn-danger" style="border-radius: 40px; width:20%;" href="{{url('/tolak',$calonmahasiswa->id)}}">Tolak Verifikasi</a>
                @else
                    <a class="btn btn-success" style="border-radius: 40px; width:20%;margin-right:1%" href="{{url('/terima',$calonmahasiswa->id)}}"> Terima Verifikasi</a>
                    <a class="btn btn-secondary" style="border-radius: 40px; width:20%;" href="{{url('/ralat',$calonmahasiswa->id)}}">Ralat Verifikasi</a>
                @endif
            @endif
        @endforeach

    </div>

</div>

@endsection
