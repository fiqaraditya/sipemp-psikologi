<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PewawancaraController;
use App\Models\Announcement;
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


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/daftar-admin',[AdminController::class, 'index'])->name("daftar_admin")->middleware('auth','checkrole:admin');

Route::get('/daftar-mahasiswa',[MahasiswaController::class, 'index'])->name("daftar_mahasiswa")->middleware('auth','checkrole:admin');
Route::get('/daftar-pewawancara',[PewawancaraController::class, 'index'])->name("daftar_pewawancara")->middleware('auth','checkrole:admin');


Route::get('/pengumuman',[AnnouncementController::class, 'index'])->name("daftar_pengumuman")->middleware('auth','checkrole:admin');
Route::get('/create-pengumuman',[AnnouncementController::class, 'create'])->name("create_pengumuman")->middleware('auth','checkrole:admin');
Route::get('/update-pengumuman/{id}',[AnnouncementController::class, 'edit'])->name("update_pengumuman")->middleware('auth','checkrole:admin' );
Route::post('/save-pengumuman',[AnnouncementController::class, 'store'])->name("save_pengumuman")->middleware('auth','checkrole:admin');
Route::post('/updated-pengumuman/{id}',[AnnouncementController::class, 'update'])->name("updated_pengumuman")->middleware('auth','checkrole:admin');
Route::get('/delete-pengumuman/{id}',[AnnouncementController::class, 'destroy'])->name("delete_pengumuman")->middleware('auth','checkrole:admin');
Route::get('/download/{id}',[AnnouncementController::class, 'download'])->name('download_pengumuman');
Route::get('/about', function () {
    return view('welcome');
});

Route::get('/submit-file-1', [DocumentController::class, 'create_lk'])->name("page_lk")->middleware('auth','checkrole:calon mahasiswa');
Route::post('/save-file-1', [DocumentController::class, 'store_lk'])->name("save_lk")->middleware('auth','checkrole:calon mahasiswa');
Route::get('/submit-file-2', [DocumentController::class, 'create_psikotest'])->name("page_psikotest")->middleware('auth','checkrole:calon mahasiswa');
Route::post('/save-file-2', [DocumentController::class, 'store_psikotest'])->name("save_psikotest")->middleware('auth','checkrole:calon mahasiswa');
Route::get('/submit-email', [DocumentController::class, 'create_email'])->name("page_email")->middleware('auth','checkrole:calon mahasiswa');
Route::post('/save-email', [DocumentController::class, 'store_email'])->name("save_email");
Route::get('/submit-file-3', [DocumentController::class, 'create_rekomendasi'])->name("page_rekomendasi")->middleware('auth', 'checkrole:calon mahasiswa');;
Route::post('/save-file-3', [DocumentController::class, 'store_rekomendasi'])->name("save_rekomendasi")->middleware('auth', 'checkrole:calon mahasiswa');
Route::get('/kelengkapan-berkas', [DocumentController::class, 'kelengkapan_berkas'])->name("kelengkapan_berkas")->middleware('auth', 'checkrole:calon mahasiswa');


