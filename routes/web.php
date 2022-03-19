<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\DocumentController;
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


Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/pengumuman',[AnnouncementController::class, 'index'])->name("daftar_pengumuman");

});

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/pengumuman',[AnnouncementController::class, 'index'])->name("daftar_pengumuman");
Route::get('/create-pengumuman',[AnnouncementController::class, 'create'])->name("create_pengumuman");
Route::get('/update-pengumuman/{id}',[AnnouncementController::class, 'edit'])->name("update_pengumuman");
Route::post('/save-pengumuman',[AnnouncementController::class, 'store'])->name("save_pengumuman");
Route::post('/updated-pengumuman/{id}',[AnnouncementController::class, 'update'])->name("updated_pengumuman");
Route::get('/delete-pengumuman/{id}',[AnnouncementController::class, 'destroy'])->name("delete_pengumuman");
Route::get('/download/{id}',[AnnouncementController::class, 'download'])->name('download_pengumuman');
Route::get('/about', function () {
    return view('welcome');
});

Route::get('/submit-file-1', [DocumentController::class, 'create_lk'])->name("page_lk");
Route::get('/save-file-1', [DocumentController::class, 'store_lk'])->name("save_lk");
Route::get('/submit-file-2', [DocumentController::class, 'create_psikotest'])->name("page_psikotest");
Route::get('/save-file-2', [DocumentController::class, 'store_psikotest'])->name("save_psikotest");
Route::get('/submit-email', [DocumentController::class, 'create_email'])->name("page_email");
Route::get('/save-email', [DocumentController::class, 'store_email'])->name("save_lk");
Route::get('/submit-file-3', [DocumentController::class, 'create_rekomendasi'])->name("page_rekomendasi");
Route::get('/save-file-3', [DocumentController::class, 'store_rekomendasi'])->name("save_rekomendasi");
Route::get('/kelengkapan-berkas', [DocumentController::class, 'kelengkapan_berkas'])->name("kelengkapan_berkas");


