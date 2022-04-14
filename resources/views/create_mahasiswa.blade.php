@extends('layout')

@section('content')
<div class="container d-flex justify-content-center mx-auto my-3">

    <div class="card card-login" style="width: 40rem;">
        <div class="card-body">
            <h1 class="card-text mb-4">Buat Calon Mahasiswa Baru</h1>
            <form action="/create-mahasiswa" method="post">
                @csrf
                <input type="hidden" name="role" value="calon mahasiswa">
                <!-- <h6>Pilih Peminatan dari Calon Mahasiswa:</h6>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="profesi" id="profesi2" value="pendidikan">
                    <label class="form-check-label" for="profesi2">Psikologi Pendidikan</label>
                </div><div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="profesi" id="profesi3" value="klinis dewasa">
                    <label class="form-check-label" for="profesi3">Psikologi Klinis Dewasa</label>
                </div><div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="profesi" id="profesi4" value="klinis anak">
                    <label class="form-check-label" for="profesi4">Psikologi Klinis Anak</label>
                </div><div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="profesi" id="profesi5" value="industri organisasi">
                    <label class="form-check-label" for="profesi5">Psikologi Industri dan Organisasi</label>
                </div> -->
                <div class="form-group">
                    <label for="exampleFormControlInput1">Pilih Peminatan dari Mahasiswa </label>
                    <select name="profesi">
                        <option value="pendidikan"> Pendidikan </option>
                        <option value="klinis dewasa"> Klinis Dewasa </option>
                        <option value="klinis anak"> Klinis Anak </option>
                        <option value="industri organisasi"> Industri Organisasi </option>
                    </select>
                </div>

                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" id="no_pendaftaran" name="no_pendaftaran" placeholder="Nomor Pendaftaran" required>
                    <label for="no_pendaftaran">Nomor Pendaftaran</label>
                </div>
                <div class="form-floating mb-3 mt-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="name" required value="{{ old('name') }}">
                    <label for="name">Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="email@example.com" required value="{{ old('email') }}">
                    <label for="email">Email address</label>
                    @error('email')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
                <div class="d-grid">
                    <button class="btn btn-login text-uppercase fw-bold"
                        style="background-color:#E48700; color:white" type="submit">Register</button>
                    <a class="btn btn-outline-dark text-uppercase fw-bold my-3"
                         type="button" href="{{route('daftar_mahasiswa')}}">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
