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
                                @if (DB::table('Documents')->where('mahasiswa_id', auth()->user()->id)->first()->email_pr1 == NULL)
                                <td><b>MENUNGGU INPUT EMAIL</b></td>  
                                @else
                                    @php
                                        $test = DB::table('Documents')->where('mahasiswa_id', auth()->user()->id)->first()->email_pr1
                                    @endphp 
                                    <td>
                                        {{$test}}
                                    </td>
                                @endif
                                @if (DB::table('Documents')->where('mahasiswa_id', auth()->user()->id)->first()->r1_id == NULL)
                                <td>Belum ada</td>  
                                @else
                                    <td>Sudah Dikumpulkan</td>
                                @endif
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                @if (DB::table('Documents')->where('mahasiswa_id', auth()->user()->id)->first()->email_pr2 == NULL)
                                    <td><b>MENUNGGU INPUT EMAIL</b></td>  
                                @else
                                    @php
                                        $test = DB::table('Documents')->where('mahasiswa_id', auth()->user()->id)->first()->email_pr2
                                    @endphp 
                                    <td>
                                        {{$test}}
                                    </td>
                                @endif
                                @if (DB::table('Documents')->where('mahasiswa_id', auth()->user()->id)->first()->r2_id == NULL)
                                <td>Belum ada</td>  
                                @else
                                    <td>Sudah Dikumpulkan</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if (DB::table('Documents')->where('mahasiswa_id', auth()->user()->id)->first()->email_pr1 == NULL ||DB::table('Documents')->where('mahasiswa_id', auth()->user()->id)->first()->email_pr2 == NULL)
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
                                        placeholder="name@example.com" name="email_pr1"> 
                                </div>
                            <br>
                                <button type="submit" class="btn btn-primary" style="border-radius: 40px; width:20%;"> Submit</button>
                        </form>
                    </div>
                </div>
            </div>   
        @endif
    {{-- cek web ini to implement lanjut : https://css-tricks.com/drag-and-drop-file-uploading/ --}}
@endsection
