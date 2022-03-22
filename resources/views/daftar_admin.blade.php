@extends('layout')

@section('content')
<div class="container" style="margin-top:3%; margin-bottom:5%">
    <div class="row">
        <h1 style="margin-bottom: 1%">Daftar Admin</h1>
        @if (auth()->user()->role=="admin")
            <a type="button" class="btn btn-primary" style="border-radius: 40px; width:20%;" href="{{route('create_admin')}}"> Buat Admin Baru</a>
         @else

        @endif
        <br>
            @foreach ($admins as $item)
            <div class="shadow card" style="margin-top:2%">
                <div class="card-body">
                    <div class="row">
                        <div class="col-1">
                            <img src="img/user-icon.png" width="90" height="90">
                        </div>


                        <div class="col-9">
                            <h3>{{ $item-> name }}</h3>
                        </div>
                        @if (auth()->user()->role=="admin")
                            <div class="col-1">
                                <a class="btn btn-warning" href="{{url('/update-pengumuman',$item->id,$item->file_path)}}"> Ubah</a>
                            </div>
                            <div class="col-1">
                                <a class="btn btn-danger" href="{{url('/delete-pengumuman',$item->id)}}" >Hapus</a>
                            </div>
                        @else

                        @endif
                    </div>
                    <br>
                    <div class="row">
                        <h5 style="font-weight: normal"> {{ $item-> email }}
                        </h5>
                    </div>

                </div>

            </div>
            @endforeach
            @include('sweetalert::alert')
        </div>
    </div>

</div>

@endsection
