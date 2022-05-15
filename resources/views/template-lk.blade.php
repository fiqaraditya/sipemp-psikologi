@extends('layout')

@section('content')
    <div style="width:1440px;border:2px solid #C9C1C1;width:100%"></div>
    <div class="container-fluid" style="margin-top:3% ">
        <div class="row" style="margin-left: 5%;margin-right:5%;padding-bottom:5%">
            <div class="shadow card">
                <div class="card-body">
                    <h2 class="card-title"> Slot Pengumpulan Template Lembar Kehidupan</h2>
                    <br>
                    
                    @if ($template->template_lk_path == NULL)
                        <form action="{{route('store_template_lk')}}"  method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="chooseFile">
                                    <label class="custom-file-label" for="chooseFile">Select file</label>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary" style="border-radius: 40px; width:20%;"> Post </button>
                                <a href="{{route('page_template')}}" class="btn btn-danger" style="border-radius: 40px; width:20%;">Batalkan </a>
                        </form>
                    @else
                    <form action="{{route('store_template_lk')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                            <div class="custom-file">
                                <input type="file" name="file" class="custom-file-input" id="chooseFile">
                                <label class="custom-file-label" for="chooseFile">Select file</label>
                            </div>
                            <br>
                            <a href="{{url('/download-template-lk')}}">Download Lembar Kehidupan</a>

                            <br>
                            <br>
                            <button type="submit" class="btn btn-primary" style="border-radius: 40px; width:20%;"> Ubah </button>
                            <a href="{{url('/delete-template-lk')}}" class="btn btn-danger" style="border-radius: 40px; width:20%;"> Hapus </a>
                    </form>  
                    @endif         
                </div>
            </div>
        </div>
    {{-- cek web ini to implement lanjut : https://css-tricks.com/drag-and-drop-file-uploading/ --}}
@endsection