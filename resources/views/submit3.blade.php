@extends('layout')

@section('content')
    <div style="width:1440px;border:2px solid #C9C1C1;width:100%"></div>

    <div class="container-fluid" style="margin-top:3% ">
        <div class="row" style="margin-left: 5%;margin-right:5%;padding-bottom:5%">
            <div class="shadow card">
                <div class="card-body">
                    <h2 class="card-title"> Slot Pengumpulan Surat Rekomendasi </h2>
                    <h6 class="card-subtitle mb-2 text-muted">
                        Format Penamaan : <br>
                        Lorem_Ipsum_Dolor_Sit_Amet <br>
                        Contoh :Consecetur_Adipiscing_Elit_Etiam
                    </h6>
                    <br>
                    
                    <form action="{{route('save_rekomendasi')}}"  method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nomor Telpon Pemberi Rekomendasi</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="+6285212345678">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Penerima Rekomendasi</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="Nama Penerima Rekomendasi">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Kode Unik Penerima Rekomendasi</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="Kode Unik Penerima Rekomendasi">
                        </div>
                        <br>
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="chooseFile">
                            <label class="custom-file-label" for="chooseFile">Select file</label>
                        </div>
                        <br>
                            <button type="submit" class="btn btn-primary" style="border-radius: 40px; width:20%;"> Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{-- cek web ini to implement lanjut : https://css-tricks.com/drag-and-drop-file-uploading/ --}}
@endsection
