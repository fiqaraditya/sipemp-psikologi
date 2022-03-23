<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
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
        return view("daftar_mahasiswa", compact('calonmahasiswas'));
    }

    public function create() {
        return view('create_mahasiswa');
    }

    public function store(Request $request) {
        $random_pass = Str::random(30);
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
        return view("detail_mahasiswa", compact('calonmahasiswa'));
    }

    public function downloadpsikotest($id)
    {
        $filepath = DB::table('documents')->where('mahasiswa_id',$id)->value('file_psikotest_path');
        Storage::download($filepath);
        return Storage::download($filepath);
    }

}
