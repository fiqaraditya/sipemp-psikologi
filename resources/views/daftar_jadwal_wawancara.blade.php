@extends('layout')

@section('content')
<div class="container" style="margin-top:3%; margin-bottom:5%">
    <div class="row">
        <h1 style="margin-bottom: 1%">Jadwal Wawancara</h1>
        @if (auth()->user()->role=="admin")
            <a type="button" class="btn btn-primary" style="border-radius: 40px; width:20%;" href="{{route('create_jadwal')}}">Tambah Jadwal Wawancara</a>
         @else

        @endif
        <br>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">
                        Tanggal</th>
                    <th scope="col">
                        Waktu Mulai</th>
                    <th scope="col">
                        Waktu Akhir</th>
                    <th scope="col">
                        Aksi</th>
                </tr>
            </thead>
            <tbody>
            @php
                $date = "";        
            @endphp
            @foreach ($schedules as $schedule)
                @if ($date != $schedule->tanggal)
                    <td><b>{{$schedule->tanggal }}</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    @php
                        $date = $schedule->tanggal;
                    @endphp
                @endif
                <tr>

                    <td>{{ $schedule->tanggal }}</td>
                    <td>{{ substr($schedule->waktu_mulai,0,-3)}}</td>
                    <td>{{ substr($schedule->waktu_akhir,0,-3)}} </td>
                    <td> 
                        <a type="button" class="btn btn-primary" href="{{url('/daftar-jadwal-wawancara',$schedule->id)}}">Lihat Detail Wawancara</a>
                        @if (auth()->user()->role=="admin")
                            <a type="button" class="btn btn-danger" href="{{url('/hapus-jadwal-wawancara',$schedule->id)}}">Hapus Wawancara</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @include('sweetalert::alert')
    </div>
</div>

</div>


@endsection