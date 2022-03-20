@extends('layout')

@section('content')
    <div class="container-fluid" style="margin-top:3% ">
        <div class="row" style="margin-left: 5%;margin-right:5%;padding-bottom:2%">
            <div class="shadow card">
                <div class="card-body">
                    <h2 class="card-title"> List Pemberi Rekomendasi </h2>
                    <h6 class="card-subtitle mb-2 text-muted">
                        Berikut Merupakan List Pemberi Rekomendasi Yang Telah Diinput dan Status File Surat Rekomendasi Saat
                        Ini
                    </h6>
                    <br>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Dolor@Sit.amet</td>
                                <td>Belum ada</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row" style="margin-left: 5%;margin-right:5%;padding-bottom:2%">
            <div class="shadow card">
                <div class="card-body">
                    <h2 class="card-title"> Input Email Pemberi Rekomendasi </h2>
                    <h6 class="card-subtitle mb-2 text-muted">
                        Pastikan Bahwa Email Yang Diinput Sudah Benar dan Tidak Ada Di List Email Yang Telah Dikirim
                    </h6>
                    <br>
                    
                    <form action="{{route('save_email')}}"  method="POST">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Email address</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1"
                                    placeholder="name@example.com">
                            </div>
                        <br>
                            <button type="submit" class="btn btn-primary" style="border-radius: 40px; width:20%;"> Submit</button>
                    </form>
                </div>
            </div>
        </div>
    {{-- cek web ini to implement lanjut : https://css-tricks.com/drag-and-drop-file-uploading/ --}}
@endsection
