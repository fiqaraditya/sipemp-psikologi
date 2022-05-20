@extends('layout')

@section('content')
<style>
    th,td{
        text-align: center;
        vertical-align: middle;
    }
</style>


@if ($sort == False)
<div class="container" style="margin-top:3%; margin-bottom:5%;">
    <div class="row">
        <h1 style="margin-bottom: 1%">Daftar Calon Mahasiswa</h1>

        <div class="col">
            <a type="button" class="btn btn-primary" style="border-radius: 40px; width:20%;" href="{{route('create_mahasiswa')}}"> Buat Calon Mahasiswa Baru</a>
            @if (count($calonmahasiswas) != 0)
                <a type="button" class="btn btn-primary" style="border-radius: 40px; width:20%; background-color:green;" href="{{route('download_berkas_zip')}}"> Download Semua Berkas</a>
                {{-- <a type="button" class="btn btn-primary" style="border-radius: 40px; width:20%;" href="{{route('result_announcement')}}"> Kirim Email Hasil Akhir</a> --}}
                <a type="button" class="btn btn-primary" style="border-radius: 40px; width:22%; background-color:green;" href="{{url('/download-user')}}"> Download Data Calon Mahasiswa </a>
                <a type="button" class="btn btn-primary" style="border-radius: 40px;;background-color:#805AD5; width:15%;" href="{{url('/daftar-mahasiswa-sort')}}"> Sort Calon Mahasiswa </a>
                <!-- <a type="button" class="btn btn-danger" style="border-radius: 40px; width:20%;" href="{{url('/delete-mahasiswa-all')}}"> Hapus Semua Calon Mahasiswa </a> -->
                <a type="button" class="btn btn-danger deleteall" href="#" style="border-radius: 40px; width:20%;" >Hapus Semua Calon Mahasiswa</a>
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
                        Status Mahasiswa </th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($calonmahasiswas as $item)
                <tr>

                    <td>{{ $item-> name }}</td>
                    <td>{{ $item-> no_pendaftaran  }}</td>
                    <td>
                        @if (is_null($item->status_penerimaan))
                            <div style="width:auto;height:40px; background-color:grey; border-radius:20px; text-align:center; margin-right:0; padding:10px; font-size:8; color:white;text-align:center;">
                                <h6>Belum Dinilai</h6>
                            </div>
                        @elseif ($item->status_penerimaan == "Disarankan")
                            <div style="width:auto;height:40px; background-color:green; border-radius:20px; text-align: center; margin-right:0; padding:10px; font-size:8; color:white;text-align:center;">
                                <h6>Disarankan</h6>
                            </div>
                        @elseif($item->status_penerimaan == "Tidak Disarankan")
                            <div style="width:auto;height:40px; background-color:red; border-radius:20px; padding:10px; text-align: center; margin-right:0; font-size:8; color:white;text-align:center;">
                                <h6>Tidak Disarankan</h6>
                            </div>
                        @endif
                    </td>
                    <td>   
                        <a type="button" class="btn btn-primary"  style="background-color:#805AD5; border:0" href="{{url('/detail-mahasiswa', $item-> id)}}"> Detail Mahasiswa</a>   
                        <!-- <a type="button" class="btn btn-danger"  style="border:0" href="{{url('/delete-mahasiswa', $item-> id)}}"> Hapus Mahasiswa</a>    -->
                        <a type="button" class="btn btn-danger delete" href="#" style="border:0" data-id="{{$item->id}}">Hapus Mahasiswa</a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

            @include('sweetalert::alert')
        </div>
    </div>

</div>


@elseif($sort == True)
<div class="container" style="margin-top:3%; margin-bottom:5%;">
    <div class="row">
        <h1 style="margin-bottom: 1%">Daftar Calon Mahasiswa</h1>

        <div class="col">
            <a type="button" class="btn btn-primary" style="border-radius: 40px; width:20%;" href="{{route('create_mahasiswa')}}"> Buat Calon Mahasiswa Baru</a>
            @if (count($mahasiswa_d) != 0 || count($mahasiswa_td) != 0 || count($mahasiswa_bd) != 0)
                <a type="button" class="btn btn-primary" style="border-radius: 40px; width:20%; background-color:green;" href="{{route('download_berkas_zip')}}"> Download Semua Berkas</a>
                {{-- <a type="button" class="btn btn-primary" style="border-radius: 40px; width:20%;" href="{{route('result_announcement')}}"> Kirim Email Hasil Akhir</a> --}}
                <a type="button" class="btn btn-primary" style="border-radius: 40px; width:22%; background-color:green;" href="{{url('/download-user')}}"> Download Data Calon Mahasiswa </a>
                <a type="button" class="btn btn-primary" style="border-radius: 40px;;background-color:#805AD5; width:15%;" href="{{url('/daftar-mahasiswa')}}"> Matikan Sort </a>
                <a type="button" class="btn btn-danger" style="border-radius: 40px; width:20%;" href="{{url('/delete-mahasiswa-all')}}"> Hapus Semua Calon Mahasiswa </a>

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
                        Status Mahasiswa </th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($mahasiswa_d as $item)
                <tr>

                    <td>{{ $item-> name }}</td>
                    <td>{{ $item-> no_pendaftaran  }}</td>
                    <td>
                        @if (is_null($item->status_wawancara))
                            <div style="width:auto;height:40px; background-color:grey; border-radius:20px; text-align:center; margin-right:0; padding:10px; font-size:8; color:white;text-align:center;">
                                <h6>Belum Dinilai</h6>
                            </div>
                        @elseif ($item->status_wawancara == "Disarankan")
                            <div style="width:auto;height:40px; background-color:green; border-radius:20px; text-align: center; margin-right:0; padding:10px; font-size:8; color:white;text-align:center;">
                                <h6>Disarankan</h6>
                            </div>
                        @elseif($item->status_wawancara == "Tidak Disarankan")
                            <div style="width:auto;height:40px; background-color:red; border-radius:20px; padding:10px; text-align: center; margin-right:0; font-size:8; color:white;text-align:center;">
                                <h6>Tidak Disarankan</h6>
                            </div>
                        @endif
                    </td>
                    <td>   
                        <a type="button" class="btn btn-primary"  style="background-color:#805AD5; border:0" href="{{url('/detail-mahasiswa', $item-> id)}}"> Detail Mahasiswa</a>   
                        <!-- <a type="button" class="btn btn-danger"  style="border:0" href="{{url('/delete-mahasiswa', $item-> id)}}"> Hapus Mahasiswa</a>    -->
                        <a type="button" class="btn btn-danger delete" href="#" style="border:0" data-id="{{$item->id}}">Hapus Mahasiswa</a>

                    </td>
                </tr>
                @endforeach

                @foreach ($mahasiswa_td as $item)
                <tr>

                    <td>{{ $item-> name }}</td>
                    <td>{{ $item-> no_pendaftaran  }}</td>
                    <td>
                        @if (is_null($item->status_penerimaan))
                            <div style="width:auto;height:40px; background-color:grey; border-radius:20px; text-align:center; margin-right:0; padding:10px; font-size:8; color:white;text-align:center;">
                                <h6>Belum Dinilai</h6>
                            </div>
                        @elseif ($item->status_penerimaan == "Disarankan")
                            <div style="width:auto;height:40px; background-color:green; border-radius:20px; text-align: center; margin-right:0; padding:10px; font-size:8; color:white;text-align:center;">
                                <h6>Disarankan</h6>
                            </div>
                        @elseif($item->status_penerimaan == "Tidak Disarankan")
                            <div style="width:auto;height:40px; background-color:red; border-radius:20px; padding:10px; text-align: center; margin-right:0; font-size:8; color:white;text-align:center;">
                                <h6>Tidak Disarankan</h6>
                            </div>
                        @endif
                    </td>
                    <td>   
                        <a type="button" class="btn btn-primary"  style="background-color:#805AD5; border:0" href="{{url('/detail-mahasiswa', $item-> id)}}"> Detail Mahasiswa</a>   
                        <!-- <a type="button" class="btn btn-danger"  style="border:0" href="{{url('/delete-mahasiswa', $item-> id)}}"> Hapus Mahasiswa</a>    -->
                        <a type="button" class="btn btn-danger delete" href="#" style="border:0" data-id="{{$item->id}}">Hapus Mahasiswa</a>

                    </td>
                </tr>
                @endforeach

                @foreach ($mahasiswa_bd as $item)
                <tr>

                    <td>{{ $item-> name }}</td>
                    <td>{{ $item-> no_pendaftaran  }}</td>
                    <td>
                        @if (is_null($item->status_penerimaan))
                            <div style="width:auto;height:40px; background-color:grey; border-radius:20px; text-align:center; margin-right:0; padding:10px; font-size:8; color:white;text-align:center;">
                                <h6>Belum Dinilai</h6>
                            </div>
                        @elseif ($item->status_penerimaan == "Disarankan")
                            <div style="width:auto;height:40px; background-color:green; border-radius:20px; text-align: center; margin-right:0; padding:10px; font-size:8; color:white;text-align:center;">
                                <h6>Disarankan</h6>
                            </div>
                        @elseif($item->status_penerimaan == "Tidak Disarankan")
                            <div style="width:auto;height:40px; background-color:red; border-radius:20px; padding:10px; text-align: center; margin-right:0; font-size:8; color:white;text-align:center;">
                                <h6>Tidak Disarankan</h6>
                            </div>
                        @endif
                    </td>
                    <td>   
                        <a type="button" class="btn btn-primary"  style="background-color:#805AD5; border:0" href="{{url('/detail-mahasiswa', $item-> id)}}"> Detail Mahasiswa</a>   
                        <!-- <a type="button" class="btn btn-danger"  style="border:0" href="{{url('/delete-mahasiswa', $item-> id)}}"> Hapus Mahasiswa</a>    -->
                        <a type="button" class="btn btn-danger delete" href="#" style="border:0" data-id="{{$item->id}}">Hapus Mahasiswa</a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

            @include('sweetalert::alert')
        </div>
    </div>

</div>
@endif

<script>
        $('.delete').click(function(){
            var itemid = $(this).attr('data-id');
            swal({
                title: "Apakah Anda yakin ingin menghapus data calon mahasiswa ini?",
                text: "Data calon mahasiswa yang dihapus tidak dapat dikembalikan",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location = "/delete-mahasiswa/"+itemid;
                    swal("Calon mahasiswa berhasil dihapus", {
                    icon: "success",
                    });
                } else {
                  
                }
                });

        });

        $('.deleteall').click(function(){
            swal({
                title: "Apakah Anda yakin ingin menghapus seluruh data calon mahasiswa?",
                text: "Data calon mahasiswa yang dihapus tidak dapat dikembalikan",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location = "/delete-mahasiswa-all/";
                    swal("Seluruh calon mahasiswa berhasil dihapus", {
                    icon: "success",
                    });
                } else {
                  
                }
                });

        });
    </script>

@endsection
