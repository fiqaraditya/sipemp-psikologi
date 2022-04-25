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
              
              @if ( $role == 'admin')
                <form action="{{route('save_pewawancara', $schedule->id)}}"  method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                @if ($interview->email_pw_1 == NULL && $interview->email_pw_2 == NULL )
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Calon Mahasiswa</label>
                            <select name="mahasiswa" id="mahasiswa" class="form-control input-lg dynamic">
                            <option value="{{$user->email}}" selected disabled >{{$user->email}}</option>
                            @foreach($all as $mahasiswa)
                                <option value="{{ $mahasiswa}}">{{ $mahasiswa}}</option>
                            @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Pewawancara 1</label>
                            <select name="pewawancara1" id="pewawancara1" class="form-control input-lg dynamic">
                            <option value="" selected disabled >Email Pewawancara 1</option>
                            @foreach($pewawancaras as $pewawancara)
                                <option value="{{ $pewawancara}}">{{ $pewawancara}}</option>
                            @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <fieldset disabled>
                                <div class="form-group">
                                    <label for="disabledTextInput">Pewawancara 2 (Opsional)</label>
                                    <input type="text" id="disabledTextInput" class="form-control" placeholder="Submit Terlebih Dahulu Pewawancara 1">
                                </div>
                            </fieldset>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary" style="border-radius: 40px; width:20%;">Ubah Peserta Wawancara</button>

                @elseif($interview->email_pw_1 != NULL && $interview->email_pw_2 == NULL)
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Calon Mahasiswa</label>
                            <select name="mahasiswa" id="mahasiswa" class="form-control input-lg dynamic">
                            <option value="{{$user->email}}" selected disabled >{{$user->email}}</option>
                            @foreach($all as $mahasiswa)
                                <option value="{{ $mahasiswa}}">{{ $mahasiswa}}</option>
                            @endforeach
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Pewawancara 1</label>
                            <select name="pewawancara1" id="pewawancara1" class="form-control input-lg dynamic">
                            <option value="{{$interview->email_pw_1}}" selected >{{$interview->email_pw_1}}</option>
                                @foreach($pewawancaras as $pewawancara)
                                    <option value="{{ $pewawancara}}">{{ $pewawancara}}</option>
                                @endforeach
                                </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Pewawancara 2</label>
                            <select name="pewawancara2" id="pewawancara2" class="form-control input-lg dynamic">
                            <option value="" selected >Email Pewawancara 2 (Opsional)</option>
                                @foreach($pewawancaras as $pewawancara)
                                    <option value="{{ $pewawancara}}">{{ $pewawancara}}</option>
                                @endforeach
                                </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary" style="border-radius: 40px; width:20%;">Ubah Peserta Wawancara</button>

                        @else
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Calon Mahasiswa</label>
                                <select name="mahasiswa" id="mahasiswa" class="form-control input-lg dynamic">
                                <option value="{{$user->email}}" selected disabled >{{$user->email}}</option>
                                @foreach($all as $mahasiswa)
                                    <option value="{{ $mahasiswa}}">{{ $mahasiswa}}</option>
                                @endforeach
                                </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Pewawancara 1</label>
                                <select name="pewawancara1" id="pewawancara1" class="form-control input-lg dynamic">
                                <option value="{{$interview->email_pw_1}}" selected >{{$interview->email_pw_1}}</option>
                                    @foreach($pewawancaras as $pewawancara)
                                        <option value="{{ $pewawancara}}">{{ $pewawancara}}</option>
                                    @endforeach
                                    </select>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Pewawancara 2</label>
                                <select name="pewawancara2" id="pewawancara2" class="form-control input-lg dynamic">
                                <option value="{{$interview->email_pw_2}}" selected >{{$interview->email_pw_2}}</option>
                                    @foreach($pewawancaras as $pewawancara)
                                        <option value="{{ $pewawancara}}">{{ $pewawancara}}</option>
                                    @endforeach
                                    </select>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary" style="border-radius: 40px; width:20%;">Ubah Peserta Wawancara</button>
                        @endif
                    </form>
              @elseif( $role == 'calon mahasiswa')
                <p class="card-text">Email Mahasiswa : {{$interview->email_mahasiswa}} </p>
                
                @if ($interview->email_pw_1 != NULL)
                    <p class="card-text">Email Pewawancara 1 : {{$interview->email_pw_1}} </p>
                @endif
                
                @if($interview->email_pw_2 != NULL)
                    <p class="card-text">Email Pewawancara 2 : {{$interview->email_pw_2}} </p>    
                @endif
              @elseif( $role == 'pewawancara')
              <p class="card-text">Email Mahasiswa : {{$interview->email_mahasiswa}} 
                  <a type="button" class="btn" href="{{url('/detail-mahasiswa',$user->id)}}" style="background-color:#805AD5; height:27px; font-size:13px; outline:none; color:white" > Lihat Profil </a>
              </p>
              {{-- IMPLEMENT BUTTON DOWNLOAD BERKAS CALON MAHASISWA -> nunggu fitur fiqar yg zip kelar --}}
                    
                @if ($interview->email_pw_1 != NULL)
                    <p class="card-text">Email Pewawancara 1 : {{$interview->email_pw_1}} </p>
                @endif
                
                @if($interview->email_pw_2 != NULL)
                    <p class="card-text">Email Pewawancara 2 : {{$interview->email_pw_2}} </p>    
                @endif
                
                {{-- IMPLEMENT INPUT FILE EXCEL HASIL WAWANCARA--}}

                <hr>
                <h5 class="card-title">Hasil Wawancara</h5>
                <p class="card-text">Catatan : 
                @if (is_null($schedule->note))
                    - </p>
                @else
                {{$schedule->note}} </p>
                @endif

                @if (is_null($schedule-> file_path ))
                    <p style="color:blue"> File hasil wawancara belum diunggah </p>
                    @else
                    <a href="{{url('/download-eval',$schedule->id)}}">Download Hasil Evaluasi Wawancara</a>
                    @endif
                </div>
                <a type="button" class="btn btn-success" style="border-radius: 40px; width:35%;" href="{{url('/submit-evaluasi',$schedule->id)}}" >Ubah hasil wawancara</a>

                @endif
                
            </div>
          </div>

        @include('sweetalert::alert')
    </div>
</div>

</div>
@endsection
