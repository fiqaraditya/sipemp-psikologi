<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use App\Models\Recommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calonmahasiswas = User::where('role', '=', 'calon mahasiswa')->get();
        $document = Document::all();
        return view("daftar_mahasiswa", compact('calonmahasiswas','document'));
    }

    public function create() {
        return view('create_mahasiswa');
    }

    public function store(Request $request) {
        // $random_pass = Str::random(30);
        $random_pass = "Password123";
        $request->request->add(['password' => $random_pass]);
        $no_pendaftaran = $request->no_pendaftaran;
        // dd($no_pendaftaran);
        $validateUser = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'role' => 'required',
            'password' => 'required|min:8',
            'profesi' => 'required',
            'no_pendaftaran' => 'required'
        ]);
        User::create($validateUser);
        $pen = DB::table('Users')->where('no_pendaftaran', $no_pendaftaran)->get()->first();
        $id = $pen->id;
        DB::table('documents')->insert(['mahasiswa_id'=>$id]);
        /* auth()->login($user);*/
        return redirect('/daftar-mahasiswa');
    }

    public function detail($id)
    {
        $calonmahasiswa = User::findorfail($id);
        $document = Document::all();
        $recommendation = Recommendation::all();
        
        return view("detail-mahasiswa", compact('calonmahasiswa', 'document', 'recommendation'));
    }

    public function downloadpsikotest($id)
    {
        $filepath = DB::table('documents')->where('mahasiswa_id',$id)->value('file_psikotest_path');
        Storage::download($filepath);
        return Storage::download($filepath);
    }
    public function downloadlk($id)
    {
        $filepath = DB::table('documents')->where('mahasiswa_id',$id)->value('file_lk_path');
        Storage::download($filepath);
        return Storage::download($filepath);
    }

    public function downloadsr1($id)
    {
        $email_pr1 =  DB::table('documents')->where('mahasiswa_id',$id)->value('email_pr1');
        $mahasiswa_key =  DB::table('users')->where('id',$id)->value('no_pendaftaran');
        $filepath = DB::table('recommendations')->where('mahasiswa_key',$mahasiswa_key)->where('email_pr', $email_pr1)->value('file_path');
        Storage::download($filepath);
        return Storage::download($filepath);
    }

    public function downloadsr2($id)
    {
        $email_pr1 =  DB::table('documents')->where('mahasiswa_id',$id)->value('email_pr2');
        $mahasiswa_key =  DB::table('users')->where('id',$id)->value('no_pendaftaran');
        $filepath = DB::table('recommendations')->where('mahasiswa_key',$mahasiswa_key)->where('email_pr', $email_pr1)->value('file_path');
        Storage::download($filepath);
        return Storage::download($filepath);
    }

    public function terima($id)
    {
        DB::table('Documents')->where('mahasiswa_id', $id)->update(['status_rekomendasi' => 1]);
        $document = Document::all();
        $calonmahasiswas = User::where('role', '=', 'calon mahasiswa')->get();
        return view("daftar_mahasiswa", compact('calonmahasiswas','document'));
    }

    public function tolak($id)
    {
        DB::table('Documents')->where('mahasiswa_id', $id)->update(['status_rekomendasi' => 0]);
        $calonmahasiswas = User::where('role', '=', 'calon mahasiswa')->get();
        $document = Document::all();
        return view("daftar_mahasiswa", compact('calonmahasiswas','document'));
    }

    public function ralat($id)
    {
        DB::table('Documents')->where('mahasiswa_id', $id)->update(['status_rekomendasi' => NULL]);
        $calonmahasiswas = User::where('role', '=', 'calon mahasiswa')->get();
        $document = Document::all();
        return view("daftar_mahasiswa", compact('calonmahasiswas','document'));
    }

}
