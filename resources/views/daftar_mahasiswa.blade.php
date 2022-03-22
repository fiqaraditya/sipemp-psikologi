@extends('layout')

@section('content')
<div class="container" style="margin-top:3%; margin-bottom:5%">
    <div class="row">
        <h1 style="margin-bottom: 1%">Daftar Calon Mahasiswa</h1>
        <a type="button" class="btn btn-primary" style="border-radius: 40px; width:20%;" href="{{route('create_mahasiswa')}}"> Buat Calon Mahasiswa Baru</a>

        <br>
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
                        Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($calonmahasiswas as $item)
                <tr>

                    <td>{{ $item-> name }}</td>
                    <td>{{ $item-> no_pendaftaran  }}</td>
                    <td> <div
                    style="width:200px;height:40px; background-color:red; border-radius:20px; padding:10px; font-size:8; color:white;text-align:center;">
                            <h6>Belum Terverifikasi </td>
                    <td>   <a type="button" class="btn btn-primary"  style="background-color:#805AD5; border:0" href="{{url('/detail-mahasiswa', $item-> id)}}"> Detail Mahasiswa</a>   </td>

                </tr>
                @endforeach
            </tbody>
        </table>

            @include('sweetalert::alert')
        </div>
    </div>

</div>

@endsection
