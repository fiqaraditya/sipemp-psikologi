<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AnnouncementController;
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

Route::get('/pengumuman',[AnnouncementController::class, 'index'])->name("daftar_pengumuman");
Route::get('/create-pengumuman',[AnnouncementController::class, 'create'])->name("create_pengumuman");
Route::get('/update-pengumuman/{id}',[AnnouncementController::class, 'edit'])->name("update_pengumuman");
Route::post('/save-pengumuman',[AnnouncementController::class, 'store'])->name("save_pengumuman");
Route::post('/updated-pengumuman/{id}',[AnnouncementController::class, 'update'])->name("updated_pengumuman");
Route::get('/delete-pengumuman/{id}',[AnnouncementController::class, 'destroy'])->name("delete_pengumuman");

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


