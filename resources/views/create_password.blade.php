@extends('layout')

@section('content')
<div class="container d-flex justify-content-center mx-auto my-3">

    <div class="card card-login" style="width: 40rem;">
        <div class="card-body">
            <h1 class="card-text mb-4">Buat Password Akun</h1>
            <form action="/set-password" method="post">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com" required>
                    <label for="email">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
                    <label for="password">Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" required>
                    <label for="password_confirmation">Konfirmasi Password</label>
                </div>
                <div class="d-grid">
                    <button class="btn btn-login text-uppercase fw-bold"
                        style="background-color:#E48700; color:white" type="submit">Register</button>
                    <a class="btn btn-outline-dark text-uppercase fw-bold my-3"
                         type="button" href="/">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
