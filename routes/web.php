<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PewawancaraController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\JadwalController;
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

Route::get('/set-password/{token}', [RegisterController::class, 'setPasswordForm'])->middleware('guest')->name('password.reset');
Route::post('/set-password', [RegisterController::class, 'setPasswordStore'])->middleware('guest')->name('password.set');

Route::get('/daftar-admin',[AdminController::class, 'index'])->name("daftar_admin")->middleware('auth','checkrole:admin');
Route::get('/create-admin',[AdminController::class, 'create'])->name("create_admin")->middleware('auth','checkrole:admin');
Route::post('/create-admin', [AdminController::class, 'store'])->name("create_admin_post")->middleware('auth','checkrole:admin');
Route::get('/delete-admin/{id}',[AdminController::class, 'destroy_admin'])->name('delete_admin')->middleware('auth','checkrole:admin');

Route::get('/daftar-mahasiswa',[MahasiswaController::class, 'index'])->name("daftar_mahasiswa")->middleware('auth','checkrole:admin');
Route::get('/daftar-mahasiswa-sort',[MahasiswaController::class, 'index_sort'])->name("daftar_mahasiswa_sort")->middleware('auth','checkrole:admin');
Route::get('/create-mahasiswa',[MahasiswaController::class, 'create'])->name("create_mahasiswa")->middleware('auth','checkrole:admin');
Route::post('/create-mahasiswa', [MahasiswaController::class, 'store'])->name("create_mahasiswa_post")->middleware('auth','checkrole:admin');
Route::get('/delete-mahasiswa/{id}',[MahasiswaController::class, 'destroy_mahasiswa'])->name('delete_mahasiswa')->middleware('auth','checkrole:admin');
Route::get('/delete-mahasiswa-all',[MahasiswaController::class, 'destroy_mahasiswa_all'])->name('delete_mahasiswa_all')->middleware('auth','checkrole:admin');


Route::get('/daftar-pewawancara',[PewawancaraController::class, 'index'])->name("daftar_pewawancara")->middleware('auth','checkrole:admin');
Route::get('/create-pewawancara',[PewawancaraController::class, 'create'])->name("create_pewawancara")->middleware('auth','checkrole:admin');
Route::post('/create-pewawancara', [PewawancaraController::class, 'store'])->name("create_pewawancara_post")->middleware('auth','checkrole:admin');
Route::get('/delete-pewawancara/{id}',[PewawancaraController::class, 'destroy_pewawancara'])->name('delete_pewawancara')->middleware('auth','checkrole:admin');

Route::get('/daftar-jadwal-wawancara',[JadwalController::class, 'index'])->name("daftar_jadwal_wawancara")->middleware('auth');
Route::get('/create-jadwal',[JadwalController::class, 'create'])->name("create_jadwal")->middleware('auth','checkrole:admin');
Route::post('/save-jadwal',[JadwalController::class, 'store'])->name("save_jadwal")->middleware('auth','checkrole:admin');
Route::get('/daftar-jadwal-wawancara/{id}',[JadwalController::class, 'edit'])->name("detail_jadwal_wawancara")->middleware('auth');
Route::post('/save-pewawancara/{id}',[JadwalController::class, 'edit_pewawancara'])->name("save_pewawancara")->middleware('auth');
Route::get('/hapus-jadwal-wawancara/{id}',[JadwalController::class, 'hapus_wawancara'])->name("hapus_wawancara")->middleware('auth','checkrole:admin');
Route::get('/submit-evaluasi/{id}',[JadwalController::class, 'submit_eval'])->name("submit_eval")->middleware('auth');
Route::post('/save-evaluasi/{id}',[JadwalController::class, 'save_eval'])->name("save_eval")->middleware('auth');
Route::get('/download-eval/{id}',[JadwalController::class, 'downloadeval'])->name('downloadeval');




Route::get('/pengumuman',[AnnouncementController::class, 'index'])->name("daftar_pengumuman")->middleware('auth','checkrole:admin');
Route::get('/create-pengumuman',[AnnouncementController::class, 'create'])->name("create_pengumuman")->middleware('auth','checkrole:admin');
Route::get('/update-pengumuman/{id}',[AnnouncementController::class, 'edit'])->name("update_pengumuman")->middleware('auth','checkrole:admin' );
Route::post('/save-pengumuman',[AnnouncementController::class, 'store'])->name("save_pengumuman")->middleware('auth','checkrole:admin');
Route::post('/updated-pengumuman/{id}',[AnnouncementController::class, 'update'])->name("updated_pengumuman")->middleware('auth','checkrole:admin');
Route::get('/delete-pengumuman/{id}',[AnnouncementController::class, 'destroy'])->name("delete_pengumuman")->middleware('auth','checkrole:admin');
Route::get('/download/{id}',[AnnouncementController::class, 'download'])->name('download_pengumuman');
Route::get('/download-psikotest/{id}',[MahasiswaController::class, 'downloadpsikotest'])->name('download_psikotest');
Route::get('/delete-psikotest/{id}',[MahasiswaController::class, 'destroy_psikotest'])->name('delete_psikotest');
Route::get('/download-lk/{id}',[MahasiswaController::class, 'downloadlk'])->name('downloadlk');
Route::get('/download-berkas-zip',[MahasiswaController::class, 'download_berkas_zip'])->name('download_berkas_zip');
Route::get('/download-berkas-zip-mahasiswa/{id}',[MahasiswaController::class, 'download_berkas_zip_mahasiswa'])->name('download_berkas_zip_mahasiswa');
Route::get('/delete-lk/{id}',[MahasiswaController::class, 'destroy_lk'])->name('delete_lk');
Route::get('/download-rekomendasi/{filename}',[MahasiswaController::class, 'downloadsr'])->name('downloadsr');



Route::get('/about', function () {
    return view('welcome');
});

Route::get('/submit-file-1', [DocumentController::class, 'create_lk'])->name("page_lk")->middleware('auth','checkrole:calon mahasiswa');
Route::post('/save-file-1', [DocumentController::class, 'store_lk'])->name("save_lk")->middleware('auth','checkrole:calon mahasiswa');
Route::get('/submit-file-2', [DocumentController::class, 'create_psikotest'])->name("page_psikotest")->middleware('auth','checkrole:calon mahasiswa');
Route::post('/save-file-2', [DocumentController::class, 'store_psikotest'])->name("save_psikotest")->middleware('auth','checkrole:calon mahasiswa');
Route::get('/submit-email', [DocumentController::class, 'create_email'])->name("page_email")->middleware('auth','checkrole:calon mahasiswa');
Route::post('/save-email', [DocumentController::class, 'store_email'])->name("save_email");
Route::get('/kelengkapan-berkas', [DocumentController::class, 'kelengkapan_berkas'])->name("kelengkapan_berkas")->middleware('auth', 'checkrole:calon mahasiswa');

Route::get('/submit-file-3', [RecommendationController::class, 'create_rekomendasi'])->name("page_rekomendasi")->middleware('guest');
Route::post('/save-file-3', [RecommendationController::class, 'store_rekomendasi'])->name("save_rekomendasi")->middleware('guest');


Route::get('/detail-mahasiswa/{id}', [MahasiswaController::class, 'detail'])->name("detail_calon_mahasiswa")->middleware('auth');
Route::get('/edit-detail-mahasiswa/{id}', [MahasiswaController::class, 'edit'])->name("edit_detail_calon_mahasiswa")->middleware('auth', 'checkrole:admin');
Route::post('/updated-mahasiswa/{id}',[MahasiswaController::class, 'update'])->name("updated_mahasiswa")->middleware('auth','checkrole:admin');

Route::get('/terima/{id}', [MahasiswaController::class, 'terima'])->name("terima_calon_mahasiswa")->middleware('auth', 'checkrole:admin');
Route::get('/tolak/{id}', [MahasiswaController::class, 'tolak'])->name("tolak_calon_mahasiswa")->middleware('auth', 'checkrole:admin');
Route::get('/ralat/{id}', [MahasiswaController::class, 'ralat'])->name("ralat_calon_mahasiswa")->middleware('auth', 'checkrole:admin');
Route::get('/notification-result', [MahasiswaController::class, 'result_announcement'])->name("result_announcement")->middleware('auth', 'checkrole:admin');

Route::get('/download-user',[MahasiswaController::class, 'download_user'])->middleware('auth', 'checkrole:admin');

Route::get('/daftar-template', [DocumentController::class, 'daftar_template'])->name("page_template")->middleware('auth','checkrole:admin');

Route::get('/submit-template-lk', [DocumentController::class, 'daftar_template_lk'])->name("page_template_lk")->middleware('auth','checkrole:admin');
Route::post('/store-template-lk', [DocumentController::class, 'store_template_lk'])->name("store_template_lk")->middleware('auth','checkrole:admin');

Route::get('/submit-template-rekomendasi', [DocumentController::class, 'daftar_template_rekomendasi'])->name("page_template_rekomendasi")->middleware('auth','checkrole:admin');
Route::post('/store-template-rekomendasi', [DocumentController::class, 'store_template_rekomendasi'])->name("store_template_rekomendasi")->middleware('auth','checkrole:admin');
Route::get('/download-template-lk',[DocumentController::class, 'download_template_lk'])->name('downloadlk');
Route::get('/delete-template-lk',[DocumentController::class, 'destroy_template_lk'])->name('deletelktemplate')->middleware('auth','checkrole:admin');
Route::get('/delete-template-rekomendasi',[DocumentController::class, 'destroy_template_rekomendasi'])->name('deleterekomendasitemplate')->middleware('auth','checkrole:admin');
Route::get('/download-template-rekomendasi',[DocumentController::class, 'download_template_rekomendasi'])->name('downloadlk');

