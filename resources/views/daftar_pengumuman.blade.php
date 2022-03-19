@extends('layout')

@section('content')
    <div class="container" style="margin-top:3%; margin-bottom:5%">
        <div class="row">
            <h1 style="margin-bottom: 1%">Daftar Pengumuman</h1>
            <br>
            <a type="button" class="btn btn-primary" style="border-radius: 40px; width:20%;" href="{{route('create_pengumuman')}}"> Buat Pengumuman</a>
            @foreach ($pengumuman as $item)
            <div class="shadow card" style="margin-top:2%">
                <div class="card-body">
                    <div class="row">
                        <div class="col-1">
                            <img src="img/user-icon.png" width="90" height="90">
                        </div>
                        
                
                        <div class="col-9">
                            <h3>{{ $item-> judul }}</h3>
                            <h5> Oleh {{ $item-> admin_id }} </h5>
                        </div>
                        <div class="col-1">
                            <a class="btn btn-warning" href="{{url('/update-pengumuman',$item->id,$item->file_path)}}"> Ubah</a>
                        </div>
                        <div class="col-1">
                            <a class="btn btn-danger" href="{{url('/delete-pengumuman',$item->id)}}" >Hapus</a>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <h5 style="font-weight: normal"> {{ $item-> isi }}
                        </h5>
                    </div>

                    @if (is_null($item-> file_path ))
                    <br>
                    @else
                    <a href="{{url('/download',$item->id)}}">Download Dokumen</a>
                    @endif
                </div>

            </div>
            @endforeach
            @include('sweetalert::alert')
        </div>
    </div>
    
@endsection
