@extends('layout')

@section('content')
    <div class="container" style="margin-top:3%; margin-bottom:5%">
        <div class="row">
            <h1 style="margin-bottom: 1%">Daftar Pengumuman</h1>
            @if (auth()->user()->role=="admin")
                <a type="button" class="btn btn-primary" style="border-radius: 40px; width:20%;" href="{{route('create_pengumuman')}}"> Buat Pengumuman</a>    
             @else
                            
            @endif
            <br>
            @foreach ($pengumuman as $item)
            <div class="shadow card" style="margin-top:2%">
                <div class="card-body">
                    <div class="row">
                        <div class="col-1">
                            <img src="img/user-icon.png" width="90" height="90">
                        </div>
                        
                
                        <div class="col-9">
                            <h4>{{ $item-> judul }}</h4>
                            @foreach ($user as $us)
                            @if($item->admin_id == $us->id)
                            <h6> By {{ $us-> name }} - {{ $item-> created_at->format('d F Y, H:i') }} </h6>
                            @endif
                            @endforeach
                        </div>
                        @if (auth()->user()->role=="admin")
                            <div class="col-1" style="padding-right: 0%; padding-left:0%">
                                <a class="btn btn-warning" href="{{url('/update-pengumuman',$item->id,$item->file_path)}}"> Ubah</a>
                            </div>
                            <div class="col-1" style="padding-right: 0%; padding-left:0%">
                                <!-- <a class="btn btn-danger delete" href="{{url('/delete-pengumuman',$item->id)}}" >Hapus</a> -->
                                <a class="btn btn-danger delete" href="#" data-id="{{$item->id}} ">Hapus</a>
                            </div>    
                        @else
                            
                        @endif
                    </div>
                    <br>
                    <div class="row">
                        <h6 style="font-weight: normal">{!! nl2br(e($item-> isi)) !!}
                        </h6>
                    </div>

                    @if (is_null($item-> file_path ))
                    @else
                    <a href="{{url('/download',$item->id)}}">Download Dokumen</a>
                    @endif
                </div>

            </div>
            @endforeach
            @include('sweetalert::alert')
        </div>
    </div>
    <script>
        $('.delete').click(function(){
            var itemid = $(this).attr('data-id');
            swal({
                title: "Apakah Anda yakin ingin menghapus pengumuman ini?",
                text: "Pengumuman yang dihapus tidak dapat dikembalikan",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location = "/delete-pengumuman/"+itemid;
                    swal("Pengumuman berhasil dihapus", {
                    icon: "success",
                    });
                } else {
                  
                }
                });

        });
    </script>
    
@endsection
