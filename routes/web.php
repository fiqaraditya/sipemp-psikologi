<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);


Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);


Route::get('/about', function () {
    return view('welcome');
});

Route::get('/submit-file-1', function () {
    return view('submit1');
});

Route::get('/submit-file-2', function () {
    return view('submit2');
});

Route::get('/submit-file-3', function () {
    return view('submit3');
});


Route::get('/submit-email', function () {
    return view('submit-email');
});

Route::get('/pengumuman', function () {
    return view('daftar_pengumuman');
});

Route::get('/create-pengumuman', function () {
    return view('create_pengumuman');
});
