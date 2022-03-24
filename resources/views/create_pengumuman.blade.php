@extends('layout')

@section('content')
    <div class="container" style="margin-top:3%; margin-bottom:5%">
        <h1>Form Tambah Pengumuman</h1>
        <br>
        <form action="{{route('save_pengumuman')}}"  method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleFormControlInput1">Judul</label>
                <input type="text" class="form-control" id="exampleFormControlInput1"
                    placeholder="Masukkan Judul Pengumuman" name="judul">
            </div>
       
            <div class="form-group">
                <label for="exampleFormControlInput1">Isi Pengumuman</label>
                <textarea class="form-control" id="exampleFormControlInput1"
                    placeholder="Masukkan Pesan Pengumuman" rows="10" name="isi"> </textarea>
            </div>
        <br>
        <h5>Lampiran</h5>
        <!-- <form class="box" method="post" action="" enctype="multipart/form-data"> -->
            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" id="chooseFile">
                <label class="custom-file-label" for="chooseFile">Select file</label>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" style="border-radius: 40px; width:20%;"> Post Pengumuman</button>
            <button type="button" class="btn btn-danger" style="border-radius: 40px; width:20%;">Batalkan</button>
        </form>
    </div>
@endsection
