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
            <div class="shadow card" style="margin-top:2%;margin-bottom:49px">
                <div class="card-body">
                    <div class="row">
                        <div class="col-1">
                            <img src="img/user-icon.png" width="60" height="60">
                        </div>
                        
                
                        <div class="col-9">
                            <h4>{{ $item-> judul }}</h4>
                            @foreach ($user as $us)
                            @if($item->admin_id == $us->id)
                            <h6> By {{ $us-> name }} - {{ $item-> created_at->format('d F Y, H:i') }} </h6>
                            @endif
                            @endforeach
                        </div>
                    </div>
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
                
            </div>
        </div>
        @include('sweetalert::alert')
    </div>

@endsection
