@extends('layout')

@section('content')
<style>
    th,td{
        text-align: center;
        vertical-align: middle;
    }
</style>
<div class="container" style="margin-top:3%; margin-bottom:5%">
    <div class="row">
        <h1 style="margin-bottom: 1%">Daftar Admin</h1>
        @if (auth()->user()->role=="admin")
            <a type="button" class="btn btn-primary" style="border-radius: 40px; width:20%;" href="{{route('create_admin')}}"> Buat Admin Baru</a>
         @else

        @endif
        <br>

        <table class="table">
            <thead>
                <tr>

                    <th scope="col">
                    <img src="img/people.png" width="12" height="14">
                        Nama</th>
                    <th scope="col">
                    <img src="img/role.png" width="16" height="16">Peran</th>
                    <th scope="col">
                    <img src="img/email.png" width="20" height="14">Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($admins as $item)
                <tr>

                    <td>{{ $item-> name }}</td>
                    <td>{{ $item-> role }}</td>
                    <td>{{ $item-> email}} </td>
                    <td><a type="button" class="btn btn-danger"  style="border:0" href="{{url('/delete-admin', $item-> id)}}"> Hapus Admin</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @include('sweetalert::alert')
    </div>
</div>

</div>

@endsection
