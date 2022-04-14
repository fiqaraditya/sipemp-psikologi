@extends('layout')

@section('content')
<div class="container" style="margin-top:3%; margin-bottom:5%">
    <div class="row">
        <h1 style="margin-bottom: 1%">Ubah Detail Calon Mahasiswa </h1>

        <div class="shadow card" style="margin-top:2%;margin-bottom:2%">
            <div class="card-body">
                <div class="row">
                    <form action="{{url('/updated-mahasiswa', $calonmahasiswa-> id)}}" method="POST"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="name"
                                value="{{$calonmahasiswa->name}}"> <br>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">ID Pendaftaran</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="no_pendaftaran"
                                value="{{$calonmahasiswa->no_pendaftaran}}"> <br>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name="email"
                                value="{{$calonmahasiswa->email}}"> 
                        </div>
                        <br>
                        
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Status Surat Rekomendasi</label> <tab3><tab3><tab3>
                            <select name="status_rekomendasi">
                                <option value="1"> Lolos Verifikasi </option>
                                <option value="0">Tidak Lolos Verifikasi </option>
                                </option>
                            </select>
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Status Penerimaan</label> <tab3><tab3><tab2>
                            <select name="status_penerimaan">
                                <option value="1">Lolos</option>
                                <option value="0">Tidak Lolos</option>
                            </select>
                        </div>

                        <br> 

                       
                        <button type="submit" class="btn btn-primary" style="border-radius: 40px; width:20%;"> Simpan</button>
                        <button type="button" class="btn btn-danger" style="border-radius: 40px; width:20%;">Batalkan</button>

                    </form>




                </div>
            </div>
        </div>
        <br>

    </div>

</div>

@endsection
