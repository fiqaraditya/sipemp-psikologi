@extends('layout')

@section('content')
<style>
    th,td{
        text-align: center;
        vertical-align: middle;
    }
</style>
<div class="container" style="margin-top:3%; margin-bottom:5%">
    @include('sweetalert::alert')
    <div class="row">
        <h1 style="margin-bottom: 1%">Daftar Pewawancara</h1>
        @if (auth()->user()->role=="admin")
            <a type="button" class="btn btn-primary" style="border-radius: 40px; width:20%;" href="{{route('create_pewawancara')}}"> Buat Pewawancara Baru</a>
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
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($pewawancaras as $item)
                <tr>
                    <td>{{ $item-> name }}</td>
                    <td>{{ $item-> role }}</td>
                    <td>{{ $item-> email}} </td>
                    <td>
                        <!-- <a type="button" class="btn btn-danger"  style="border:0" href="{{url('/delete-pewawancara', $item-> id)}}"> Hapus Pewawancara</a> -->
                        <a type="button" class="btn btn-danger delete" href="#" style="border:0" data-id="{{$item->id}} ">Hapus Pewawancara</a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
<script>
        $('.delete').click(function(){
            var itemid = $(this).attr('data-id');
            swal({
                title: "Apakah Anda yakin ingin menghapus data pewawancara ini?",
                text: "Data pewawancara yang dihapus tidak dapat dikembalikan",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location = "/delete-pewawancara/"+itemid;
                    swal("Pewawancara berhasil dihapus", {
                    icon: "success",
                    });
                } else {
                  
                }
                });

        });
</script>

@endsection
