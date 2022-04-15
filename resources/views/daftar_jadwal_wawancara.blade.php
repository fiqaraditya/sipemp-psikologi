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
            @foreach ($schedules as $schedule)
                <tr>

                    <td>{{ $schedule-> tanggal }}</td>
                    <td>{{ substr($schedule-> waktu_mulai,0,-3)}}</td>
                    <td>{{ substr($schedule-> waktu_akhir,0,-3)}} </td>
                    <td> <a type="button" class="btn btn-primary" href="{{url('/daftar-jadwal-wawancara',$schedule->id)}}">Lihat Daftar Wawancara</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @include('sweetalert::alert')
    </div>
</div>

</div>


@endsection