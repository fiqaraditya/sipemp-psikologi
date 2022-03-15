@extends('layout')

@section('content')
    <div class="container" style="margin-top:3%; margin-bottom:5%">
        <h1>Form Pengumuman</h1>
        <br>
        <form>
            <div class="form-group">
                <label for="exampleFormControlInput1">Judul</label>
                <input type="text" class="form-control" id="exampleFormControlInput1"
                    placeholder="Masukkan Judul Pengumuman">
            </div>
        </form>
        <br>
        <form>
            <div class="form-group">
                <label for="exampleFormControlInput1">Pesan</label>
                <input type="text" class="form-control" id="exampleFormControlInput1"
                    placeholder="Masukkan Pesan Pengumuman">
            </div>
        </form>
        <br>
        <h5>File Surat Rekomendasi</h5>
        <form class="box" method="post" action="" enctype="multipart/form-data">
            <div class="box__input">
                <input class="box__file" type="file" name="files[]" id="file" data-multiple-caption="{count} files selected"
                    multiple />
                <br>
                <br>
            </div>
        </form>
        <button type="button" class="btn btn-primary" style="border-radius: 40px; width:20%;">Post Pengumuman</button>
        <button type="button" class="btn btn-danger" style="border-radius: 40px; width:20%;">Batalkan</button>
    </div>
@endsection
