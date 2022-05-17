@extends('layout')

@section('content')
    <div style="width:1440px;border:2px solid #C9C1C1;width:100%"></div>

    <div class="container-fluid" style="margin-top:3% ">
        <div class="row" style="margin-left: 5%;margin-right:5%;padding-bottom:5%">
            <div class="shadow card">
                <div class="card-body">
                    <h2 class="card-title"> Slot Pengumpulan Surat Rekomendasi </h2>
                    @if ($template->template_rekomendasi_path== NULL)
                    @else
                        <a href="{{url('/download-template-rekomendasi')}}">Download Template Rekomendasi</a>
                    @endif 
                   
                    <h6 class="card-subtitle mb-2 text-muted">
                        Format Penamaan : <br>
                        REKOMENDASI_NamaCalonMahasiswa_NomorMahasiswa_NamaPemberiRekomendasi <br>
                        Contoh :REKOMENDASI_Budi Santoso_190543243_Kurniawan Anggun
                    </h6>
                    <br>
                    
                    <form action="{{route('save_rekomendasi')}}"  method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email Pemberi Rekomendasi</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="Email Pemberi Rekomendasi" name="email_pr">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nomor Telpon Pemberi Rekomendasi</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="Nomor Telpon Pemberi Rekomendasi" name="no_telp">
                        </div>
                        <br>
                        <h6>Peran Anda Terhadap Calon Mahasiswa</h6>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="peran" id="peran2" value="pembimbing akademik">
                            <label class="form-check-label" for="peran">Pembimbing Akademik</label>
                        </div><div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="peran" id="peran3" value="pembimbing skripsi">
                            <label class="form-check-label" for="peran">Pembimbing Skripsi</label>
                        </div><div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="peran" id="peran4" value="dosen yang mengenal baik">
                            <label class="form-check-label" for="peran">Dosen yang Mengenal Baik</label>
                        </div><div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="peran" id="peran5" value="atasan">
                            <label class="form-check-label" for="peran">Atasan</label>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Penerima Rekomendasi</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="Nama Penerima Rekomendasi" name="mahasiswa_rekomendasi">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nomor Ujian Penerima Rekomendasi</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="Kode Unik Penerima Rekomendasi" name="kode_unik_mahasiswa">
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
