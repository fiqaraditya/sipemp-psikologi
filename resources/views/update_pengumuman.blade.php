@extends('layout')

@section('content')
    <div class="container" style="margin-top:3%; margin-bottom:5%">
        <h1>Form Update Pengumuman</h1>
        <br>
        <form action="{{url('/updated-pengumuman', $pen-> id)}}"  method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleFormControlInput1">Judul</label>
                <input type="text" class="form-control" id="exampleFormControlInput1"
                    placeholder="Masukkan Judul Pengumuman" name="judul" value="{{$pen-> judul}}">
            </div>
       
            <div class="form-group">
                <label for="exampleFormControlInput1">Isi Pengumuman</label>
                <textarea class="form-control" id="exampleFormControlInput1"
                    placeholder="Masukkan Pesan Pengumuman" rows="10" name="isi">{{($pen-> isi)}}</textarea> 
            </div>
        <br>
        <h5>Lampiran</h5>
        <!-- <form class="box" method="post" action="" enctype="multipart/form-data"> -->
            @if (is_null($pen-> file_path ))
            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" id="chooseFile">
                <label class="custom-file-label" for="chooseFile">Select file</label>
            </div>
            @else
            <a href="{{url('/download',$pen->id)}}">Download Dokumen</a>
            <br>
            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" id="chooseFile">
                <label class="custom-file-label" for="chooseFile">Ubah file</label>
            </div>      
            @endif
            </div>
            <button type="submit" class="btn btn-primary" style="margin-left:10%;border-radius: 40px; width:20%;"> Ubah Pengumuman</button>
            <button type="button" class="btn btn-danger" style="border-radius: 40px; width:20%;">Batalkan</button>
        </form>
        <br>
        <br>
    </div>
@endsection
