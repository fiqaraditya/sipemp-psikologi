@extends('layout')

@section('content')
@if($role == 'admin')
<div class="container" style="margin-top:3%; margin-bottom:5%">
    <div class="row">
        <h1 style="margin-bottom: 1%">Detail Calon Mahasiswa </h1>

        <div class="shadow card" style="margin-top:2%;margin-bottom:2%">
            <div class="card-body">
                <div class="row">
                    <div display="flex">
                        <h2 style="text-align:center;"> {{$calonmahasiswa->name}}</h2>
                        <div>
                            <a style="float: right" class="btn btn-danger btn-sm"> Hapus </a>
                            <a style="float: right;margin-right:1%" class="btn btn-primary btn-sm"
                                href="{{url('/edit-detail-mahasiswa',$calonmahasiswa->id)}}"> Ubah </a>
                        </div>
                    </div>
                    <br>
                    <hr style="margin-top:1%">
                    <h5 style="color:grey;"> Informasi Umum </h5>

                    <h5> ID Pendaftaran <tab3>
                            <tab3>
                                <tab3> : <tab2> {{$calonmahasiswa->no_pendaftaran}}</h5> <br>
                    <h5> Email <tab3>
                            <tab3>
                                <tab3> : <tab2> {{$calonmahasiswa->email}} </h5>
                   
                        <h5> Status Mahasiswa <tab3><tab3><tab3> : <tab2>
                        @if (is_null($calonmahasiswa-> status_penerimaan))
                            Belum<tab1>Dinilai </h5>
                        @elseif ($calonmahasiswa-> status_penerimaan == "Disarankan")
                            Disarankan </h5>
                        @else
                            Tidak<tab1>Disarankan </h5>
                        @endif
                        <br>


                            <br>
                            <hr>

                            <h5 style="color:grey;"> Berkas </h5>

                            

                            <br>
                            
                            <div style="display:flex">
                                <h5 style="flex-grow: 1;"> Lingkungan Kehidupan </h5>
                                @foreach ($document as $doc)
                                @if($doc->mahasiswa_id == $calonmahasiswa->id)
                                @if (is_null($doc-> file_lk_path))
                                <br>
                                @else
                                <a class="btn btn-primary" href="{{url('/download-lk',$calonmahasiswa->id)}}"
                                    style="margin-top: 1%; margin-bottom : 1%;width:255px">Download Lembar Kehidupan</a>
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
                                        <a class="btn btn-primary" style="text-align:justify;width:255px;margin-top:4%"
                                            href="{{url('/download-rekomendasi', $filename)}}">Download Surat Rekomendasi
                                            {{++$count}} </a>
                                    </div>
        
                                    @endif
        
                                    @endforeach
                                </div>
                            
                        </div>
            </div>
        </div>
        <br>
    </div>
</div>
@elseif($role == 'pewawancara')
<div class="container" style="margin-top:3%; margin-bottom:5%">
    <div class="row">
        <h1 style="margin-bottom: 1%">Detail Calon Mahasiswa </h1>

        <div class="shadow card" style="margin-top:2%;margin-bottom:2%">
            <div class="card-body">
                <div class="row">
                    <div display="flex">
                        <h2 style="text-align:center;"> {{$calonmahasiswa->name}}</h2>

                    </div>


                    <hr>
                    <h5 style="color:grey;"> Informasi Umum </h5>

                    <h5> ID Pendaftaran <tab3>
                            <tab3>
                                <tab3> : <tab2> {{$calonmahasiswa->no_pendaftaran}}</h5> <br>
                    <h5> Email <tab3>
                            <tab3>
                                <tab3> : <tab2> {{$calonmahasiswa->email}} </h5>
                    <h5> Status Rekomendasi <tab3>
                            <tab3>
                                <tab3> : <tab2>
                    @foreach ($document as $doc)
                    @if ($doc->mahasiswa_id == $calonmahasiswa->id)
                    @if (is_null($doc-> status_rekomendasi))

                    Belum<tab1>diverifikasi </h5>

                    @elseif ($doc-> status_rekomendasi == 1)

                    Terverifikasi  </h5>

                    @else
                    Tidak<tab1>Lolos </h5>
                        @endif
                        @endif
                        @endforeach

                        <h5> Status Penerimaan <tab3><tab3><tab3> : <tab2>
                        @if (is_null($calonmahasiswa-> status_penerimaan))
                            Belum<tab1>ditentukan </h5>
                            @elseif ($calonmahasiswa-> status_penerimaan == 1)
                            Lolos </h5>
                        @else
                            Tidak<tab1>Lolos </h5>
                        @endif
                        <br>


                            <br>
                            <hr>

                            <h5 style="color:grey;"> Berkas </h5>

                            <div style="display:flex">
                                <h5 style="flex-grow: 1;"> Hasil Psikotest </h5>
                                @foreach ($document as $doc)
                                @if($doc->mahasiswa_id == $calonmahasiswa->id)
                                @if (is_null($doc-> file_psikotest_path ))
                                @else
                                <a class="btn btn-primary" href="{{url('/download-psikotest',$calonmahasiswa->id)}}"
                                    style="width:255px">Download Hasil Psikotest</a>
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
                                    <a class="btn btn-primary" style="text-align:justify;width:255px;margin-top:4%"
                                        href="{{url('/download-rekomendasi', $filename)}}">Download Surat Rekomendasi
                                        {{++$count}} </a>
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
                                <a class="btn btn-primary" href="{{url('/download-lk',$calonmahasiswa->id)}}"
                                    style="margin-top: 1%; margin-bottom : 1%;width:255px">Download Lembar Kehidupan</a>
                                @endif
                                @endif
                                @endforeach
                            </div>

                </div>
            </div>
        </div>
        <br>
    </div>
</div>

@endif

@endsection
