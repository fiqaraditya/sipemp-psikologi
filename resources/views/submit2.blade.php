@extends('layout')

@section('content')
    <div style="width:1440px;border:2px solid #C9C1C1;width:100%"></div>

    <div class="container-fluid" style="margin-top:3% ">
        <div class="row" style="margin-left: 5%;margin-right:5%;padding-bottom:5%">
            <div class="shadow card">
                <div class="card-body">
                    <h2 class="card-title"> Slot Pengumpulan Psikotest </h2>
                    <h6 class="card-subtitle mb-2 text-muted">
                        Format Penamaan : <br>
                        Lorem_Ipsum_Dolor_Sit_Amet <br>
                        Contoh :Consecetur_Adipiscing_Elit_Etiam
                    </h6>
                    <br>
                    @if ($document->where('mahasiswa_id', auth()->user()->id)->first()->file_psikotest_path == NULL)
                        <form action="{{route('save_psikotest')}}"  method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="chooseFile">
                                    <label class="custom-file-label" for="chooseFile">Select file</label>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary" style="border-radius: 40px; width:20%;"> Post </button>
                                <a href="{{route('kelengkapan_berkas')}}" class="btn btn-danger" style="border-radius: 40px; width:20%;">Batalkan </a>
                        </form>
                    @else
                        <form action="{{route('save_psikotest')}}"  method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="chooseFile">
                                    <label class="custom-file-label" for="chooseFile">Select file</label>
                                </div>
                                <br>
                                <a href="{{url('/download-psikotest',auth()->user()->id)}}">Download Hasil Psikotest</a>
                                <br>
                                <br>
                                <button type="submit" class="btn btn-primary" style="border-radius: 40px; width:20%;"> Ubah </button>
                                <a href="{{url('/delete-psikotest',auth()->user()->id)}}" class="btn btn-danger" style="border-radius: 40px; width:20%;">Hapus </a>
                        </form>
                    @endif
                </div>
            </div>
        </div>
{{-- cek web ini to implement lanjut : https://css-tricks.com/drag-and-drop-file-uploading/ --}}
@endsection
