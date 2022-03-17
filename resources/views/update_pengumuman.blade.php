@extends('layout')

@section('content')
    <div class="container" style="margin-top:3%; margin-bottom:5%">
        <h1>Form Update Pengumuman</h1>
        <br>
        <form action="{{url('/updated-pengumuman', $pen-> id)}}"  method="POST">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleFormControlInput1">Judul</label>
                <input type="text" class="form-control" id="exampleFormControlInput1"
                    placeholder="Masukkan Judul Pengumuman" name="judul" value="{{$pen-> judul}}">
            </div>
       
            <div class="form-group">
                <label for="exampleFormControlInput1">Isi Pengumuman</label>
                <input type="text" class="form-control" id="exampleFormControlInput1"
                    placeholder="Masukkan Pesan Pengumuman" rows="10" name="isi" value="{{$pen-> isi}}"> </input>
            </div>
        <br>
        <h5>Lampiran</h5>
        <!-- <form class="box" method="post" action="" enctype="multipart/form-data"> -->
            <div class="box__input">
                <input class="box__file" type="file" name="files[]" id="file" data-multiple-caption="{count} files selected"
                    multiple />
                <br>
                <br>
            </div>
            <button type="submit" class="btn btn-primary" style="border-radius: 40px; width:20%;"> Ubah Pengumuman</button>
            <button type="button" class="btn btn-danger" style="border-radius: 40px; width:20%;">Batalkan</button>
        </form>
    </div>
@endsection
