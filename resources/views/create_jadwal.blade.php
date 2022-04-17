@extends('layout')

@section('content')
    <div class="container" style="margin-top:3%; margin-bottom:5%">
        <h1>Tambah Jadwal Wawancara</h1>
        <br>
        <form action="{{route('save_jadwal')}}"  method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
            <div class="form-group">
                <label for="exampleFormControlInput1">Tanggal</label>
                <input type="date" class="form-control" id="exampleFormControlInput1"
                    placeholder="Pilih Tanggal Wawancara" name="tanggal">
            </div>
            <br>
            <div class="form-group">
                <label for="exampleFormControlInput1">Waktu Mulai</label>
                <input type="time" class="form-control" id="exampleFormControlInput1"
                    placeholder="Pilih Tanggal Wawancara" name="waktu_mulai">
            </div>
            <br>
            <div class="form-group">
                <label for="exampleFormControlInput1">Waktu Akhir</label>
                <input type="time" class="form-control" id="exampleFormControlInput1"
                    placeholder="Pilih Tanggal Wawancara" name="waktu_akhir">
            </div>
            <br>
            {{-- <div class="form-group">
                <label for="exampleFormControlInput1">Calon Mahasiswa</label>
                <input type="text" class="form-control" id="exampleFormControlInput1"
                    placeholder="Pilih Calon Mahasiswa" name="calon_mahasiswa">
            </div> --}}
            <div class="form-group">
                <label for="exampleFormControlInput1">Calon Mahasiswa</label>
                <select name="mahasiswa" id="mahasiswa" class="form-control input-lg dynamic" data-dependent="pewawancara1" >
                 <option value="" selected disabled>Email Calon Mahasiswa</option>
                 @foreach($calon_mahasiswa as $mahasiswa)
                 <option value="{{ $mahasiswa}}">{{ $mahasiswa}}</option>
                 @endforeach
                </select>
            </div>
            <br>
            
            {{-- <div class="form-group">
                <label for="exampleFormControlInput1">Pewawancara 1</label>
                <select name="pewawancara1" id="pewawancara1" class="form-control input-lg dynamic" data-dependent="pewawancara2" >
                 <option value="" selected disabled>Email Pewawancara Pertama</option>
                </select>
            </div>
            <br>
            
            <div class="form-group">
                <label for="exampleFormControlInput1">Pewawancara 2</label>
                <select name="pewawancara2" id="pewawancara2" class="form-control input-lg">
                 <option value="" selected disabled>Email Pewawancara Kedua (Opsional)</option>
                </select>
            </div> --}}
            <br>
            <button type="submit" class="btn btn-primary" style="border-radius: 40px; width:20%;"> Simpan Jadwal Wawancara</button>
            <button type="button" class="btn btn-danger" style="border-radius: 40px; width:20%;">Batalkan</button>
        </form>
    </div>
@endsection

{{-- @push('script')

<script>
    $(document).ready(function(){

        $('.dynamic').change(function(){
            if($(this).val() != ''){
                var select = $(this).attr("id");
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ route('JadwalController.fetch') }}",
                    method:"POST",
                    data:{select:select, value:value, _token:_token, dependent:dependent},
                    success:function(result)
                    {
                    $('#'+dependent).html(result);
                    }

                })
            }
        })    
            
    })
</script> --}}

{{-- @endpush --}}
