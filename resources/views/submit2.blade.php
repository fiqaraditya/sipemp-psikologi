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
                    <form class="box" method="post" action="" enctype="multipart/form-data">
                        <div class="box__input">
                            <input class="box__file" type="file" name="files[]" id="file"
                                data-multiple-caption="{count} files selected" multiple />
                            <br>
                            <br>
                            <button type="submit" class="btn btn-primary mb-2">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
{{-- cek web ini to implement lanjut : https://css-tricks.com/drag-and-drop-file-uploading/ --}}
@endsection
