@extends('layout')

@section('content')
    <div class="container-fluid" style="margin-top:3% ">
        <div class="row" style="margin-left: 5%;margin-right:5%;padding-bottom:5%">
            <div class="col-4">
                <iframe
                    src="https://calendar.google.com/calendar/embed?src=c_d156qcj9ogqjgu6qncosvmnebs%40group.calendar.google.com&ctz=Asia%2FJakarta"
                    style="border: 0" width="100%" height="600" frameborder="0" scrolling="no"></iframe>
            </div>
            <div class="col-8" style="margin-top: 2%">
                <h1>Pengumuman Penerimaan</h1>
                <br>
                @foreach ($pengumuman as $item)
            <div class="shadow card" style="margin-top:2%">
                <div class="card-body">
                    <div class="row">
                        <div class="col-1">
                            <img src="img/user-icon.png" width="50" height="50">
                        </div>
                        
                
                        <div class="col-9">
                            <h3>{{ $item-> judul }}</h3>
                            @foreach ($user as $us)
                            @if($item->admin_id == $us->id)
                                <h5> Oleh {{ $us-> name }} </h5>
                            @endif
                            @endforeach
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
                
            </div>
        </div>

    </div>

@endsection
