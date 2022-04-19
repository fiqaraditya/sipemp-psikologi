@extends('layout')

@section('content')
<div class="container" style="margin-top:3%; margin-bottom:5%">
    <div class="row">
        <h1 style="margin-bottom: 1%">Detail Wawancara</h1>

        <div class="card" style="padding: 0% 0%">
            <div class="card-header text-center">
                <h4><b>{{$schedule->tanggal}}</b></h4>
            </div>
            <div class="card-body">
                <h5 class="card-title">Waktu dan Tempat Wawancara</h5>
                <p class="card-text">Waktu Mulai : {{substr($schedule->waktu_mulai,0,-3)}} </p>
                <p class="card-text">Waktu Selesai : {{substr($schedule->waktu_akhir,0,-3)}} </p>
                <hr>
                <h5 class="card-title">Peserta Wawancara</h5>
                <p class="card-text">Email Mahasiswa : {{$interview->email_mahasiswa}} </p>
                
                @if ($interview->email_pw_1 != NULL)
                <p class="card-text">Email Pewawancara 1 : {{$interview->email_pw_1}} </p>
                @endif

                @if($interview->email_pw_2 != NULL)
                <p class="card-text">Email Pewawancara 2 : {{$interview->email_pw_2}} </p>
                @endif
                <hr>
                <h5 class="card-title">Hasil Wawancara</h5>

                <form action="{{url('save-evaluasi',$schedule-> id)}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                            <label for="exampleFormControlInput1">Catatan</label> <tab3><tab3><tab2>
                            <select name="note">
                                <option value="">Tidak Ada</option>
                                <option value="Berpotensi masalah">Berpotensi masalah</option>
                                <option value="Disarankan">Disarankan</option>
                            </select>
                        </div>
                    <br>
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="chooseFile">
                        <label class="custom-file-label" for="chooseFile">Select file</label>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" style="border-radius: 40px; width:35%;"> Simpan Hasil Wawancara</button>
                    <button type="button" class="btn btn-danger"
                        style="border-radius: 40px; width:20%;">Batalkan</button>
                </form>
            </div>

        </div>


        @include('sweetalert::alert')
    </div>
</div>

</div>
@endsection
