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
                        Waktu</th>
                    <th scope="col">
                        Aksi</th>
                </tr>
            </thead>
            <tbody>
            {{-- @foreach ($admins as $item)
                <tr>

                    <td>{{ $item-> name }}</td>
                    <td>{{ $item-> role }}</td>
                    <td>{{ $item-> email}} </td>
                </tr>
                @endforeach --}}
            </tbody>
        </table>

        @include('sweetalert::alert')
    </div>
</div>

</div>


@endsection