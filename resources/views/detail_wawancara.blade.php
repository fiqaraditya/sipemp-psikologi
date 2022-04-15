@extends('layout')

@section('content')
<div class="container" style="margin-top:3%; margin-bottom:5%">
    <div class="row">
        <h1 style="margin-bottom: 1%">Detail Wawancara</h1>
        
        <div class="card">
            <div class="card-header text-center">
                <h4><b>{{$schedule->tanggal}}</b></h4>
              </div>
            <div class="card-body">
              <h5 class="card-title">Waktu dan Tempat Wawancara</h5>
              <p class="card-text">Waktu Mulai : {{substr($schedule->waktu_mulai,0,-3)}} </p>
              <p class="card-text">Waktu Selesai : {{substr($schedule->waktu_akhir,0,-3)}} </p>
              <a href="#" class="btn btn-primary">Ubah Waktu dan Tempat Wawancara</a>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Peserta Wawancara</h5>
              {{-- <p class="card-text">Calon Mahasiswa : {{$user->name}}</p> --}}
              <a href="#" class="btn btn-primary">Button</a>
            </div>
          </div>

        @include('sweetalert::alert')
    </div>
</div>

</div>
@endsection
