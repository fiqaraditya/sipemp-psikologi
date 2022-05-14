@extends('layout')

@section('content')
<div class="container" style="margin-top:3%; margin-bottom:5%">
    <div class="row">
        <h1 style="margin-bottom: 1%">Daftar Calon Mahasiswa</h1>
        <div class="col">
            <a type="button" class="btn btn-primary" style="border-radius: 40px; width:20%;" href="{{route('create_mahasiswa')}}"> Buat Calon Mahasiswa Baru</a>
            @if (count($calonmahasiswas) != 0)
                <a type="button" class="btn btn-primary" style="border-radius: 40px; width:20%;" href="{{route('download_berkas_zip')}}"> Download Semua Berkas</a>
                {{-- <a type="button" class="btn btn-primary" style="border-radius: 40px; width:20%;" href="{{route('result_announcement')}}"> Kirim Email Hasil Akhir</a> --}}
                <a type="button" class="btn btn-primary" style="border-radius: 40px; width:25%;" href="{{url('/download-user')}}"> Download Data Calon Mahasiswa </a>
            @endif
        </div>

    </div>
    <br>
    <div class="row">
            <table class="table">
            <thead>
                <tr>

                    <th scope="col">
                    <img src="img/people.png" width="12" height="14">
                        Nama
                    </th>
                    <th scope="col">
                    <img src="img/no_pendaftaran.png" width="18" height="18">
                        ID Pendaftaran
                    </th>
                    <th scope="col">
                    <img src="img/status.png" width="18" height="18">
                        Status Dokumen </th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($calonmahasiswas as $item)
                <tr>

                    <td>{{ $item-> name }}</td>
                    <td>{{ $item-> no_pendaftaran  }}</td>
                    <td>
                        @foreach ($document as $doc)
                        @if ($doc->mahasiswa_id == $item->id)
                            @if (is_null($doc-> status_rekomendasi))
                                <div style="width:200px;height:40px; background-color:grey; border-radius:20px; padding:10px; font-size:8; color:white;text-align:center;">
                                    <h6>Belum Terverifikasi</h6>
                                </div>
                            @elseif ($doc-> status_rekomendasi == 1)
                                <div style="width:200px;height:40px; background-color:green; border-radius:20px; padding:10px; font-size:8; color:white;text-align:center;">
                                    <h6>Lolos Verifikasi</h6>
                                </div>
                            @else
                            <div style="width:200px;height:40px; background-color:red; border-radius:20px; padding:10px; font-size:8; color:white;text-align:center;">
                                <h6>Tidak Lolos Verifikasi</h6>
                            </div>
                            @endif
                        @endif
                    @endforeach

                    </td>
                    <td>   
                        <a type="button" class="btn btn-primary"  style="background-color:#805AD5; border:0" href="{{url('/detail-mahasiswa', $item-> id)}}"> Detail Mahasiswa</a>   
                        <a type="button" class="btn btn-danger"  style="border:0" href="{{url('/delete-mahasiswa', $item-> id)}}"> Hapus Mahasiswa</a>   
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

            @include('sweetalert::alert')
        </div>
    </div>

</div>

@endsection
