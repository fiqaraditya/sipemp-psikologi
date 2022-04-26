<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use App\Models\Recommendation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;


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
            'email' => ['required', 'email:dns', 'unique:users'],
            'role' => 'required',
            'password' => 'required|min:8',
            'profesi' => 'required',
            'no_pendaftaran' => 'required'
        ]);
        $validateUser['password'] = Hash::make($validateUser['password']);
        // dd($request->id);
        User::create($validateUser);
        Password::sendResetLink($request->only(['email']));
        // $pen = DB::table('Users')->where('no_pendaftaran', $no_pendaftaran)->first();
        $pen = User::where('no_pendaftaran',$no_pendaftaran)->firstOrFail();
        $id = $pen->id;
        DB::table('documents')->insert(['mahasiswa_id'=>$id]);
        /* auth()->login($user);*/
        return redirect('/daftar-mahasiswa')->with('success', 'Calon Mahasiswa baru berhasil didaftarkan');;
    }

    public function detail($id)
    {
        $calonmahasiswa = User::findorfail($id);
        $document = Document::all();
        $recommendation = Recommendation::all();
        $role = auth()->user()->role;

        return view("detail-mahasiswa", compact('calonmahasiswa', 'document', 'recommendation', 'role'));
    }

    public function edit($id)
    {
        $calonmahasiswa = User::findorfail($id);
        $document = Document::all();
        $recommendation = Recommendation::all();

        return view("edit_mahasiswa", compact('calonmahasiswa', 'document', 'recommendation'));
    }

    public function update(Request $request, $id)
    {
        $cm = User::findorfail($id);
        $cm->name = $request->name;
        $cm->email = $request->email;
        $cm->no_pendaftaran = $request->no_pendaftaran;
        $cm->status_penerimaan = $request->status_penerimaan;
        $cm->save();

        Document::where('mahasiswa_id', $id)->update(['status_rekomendasi' => $request->status_rekomendasi]);

        return redirect()->to('detail-mahasiswa/'.$id)->with('success', 'Pengumuman berhasil diubah');
    }

    public function downloadpsikotest($id)
    {
        $filepath = DB::table('documents')->where('mahasiswa_id',$id)->value('file_psikotest_path');
        Storage::download($filepath);
        return Storage::download($filepath);
    }

    public function destroy_psikotest($id)
    {
        $filepath = Document::where('mahasiswa_id', $id)->value('file_psikotest_path');
        Storage::delete($filepath);
        Document::where('mahasiswa_id', $id)->update(['file_psikotest_path' => NULL]);
        $document = Document::all();
        $recommendation = Recommendation::where('mahasiswa_id',auth()->user()->id)->where('mahasiswa_key',auth()->user()->no_pendaftaran)->get();
        return view('kelengkapan_berkas',compact('document','recommendation'));
    }

    public function downloadlk($id)
    {
        $filepath = DB::table('documents')->where('mahasiswa_id',$id)->value('file_lk_path');
        Storage::download($filepath);
        return Storage::download($filepath);
    }

    public function destroy_lk($id)
    {
        $filepath = Document::where('mahasiswa_id', $id)->value('file_lk_path');
        Storage::delete($filepath);
        Document::where('mahasiswa_id', $id)->update(['file_lk_path' => NULL]);
        $document = Document::all();
        $recommendation = Recommendation::where('mahasiswa_id',auth()->user()->id)->where('mahasiswa_key',auth()->user()->no_pendaftaran)->get();
        return view('kelengkapan_berkas',compact('document','recommendation'));
    }

    public function downloadsr($filename)
    {
        $filepath = 'public/recommendation/' . $filename;
        // $email_pr1 =  DB::table('documents')->where('mahasiswa_id',$id)->value('email_pr1');
        // $mahasiswa_key =  DB::table('users')->where('id',$id)->value('no_pendaftaran');
        // $filepath = DB::table('recommendations')->where('mahasiswa_key',$mahasiswa_key)->where('email_pr', $email_pr1)->value('file_path');
        // Storage::download($filepath);
        return Storage::download($filepath);
    }

    public function download_berkas_zip()
    {
        $zip = new \ZipArchive();
        $zip_master = 'dokumen mahasiswa.zip';
        $zip->open($zip_master, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $calonmahasiswas = User::where('role', '=', 'calon mahasiswa')->get();

        foreach ($calonmahasiswas as $calonmahasiswa) {

            $nama = $calonmahasiswa->name;
            $no_pendaftaran = $calonmahasiswa->no_pendaftaran;
            $base_path = $no_pendaftaran.'-'.$nama;
            //file lk
            $lk_mahasiswa = Document::where('mahasiswa_id', $calonmahasiswa->id)->value('file_lk_path');
            if(!is_null($lk_mahasiswa)){
                $lk_realpath = Storage::path($lk_mahasiswa);
                $zip->addFile($lk_realpath, $base_path.'/'.'lk'.'/'.basename($lk_realpath));
            }

            //file psikotest
            $psikotest_mahasiswa = Document::where('mahasiswa_id', $calonmahasiswa->id)->value('file_psikotest_path');
            if(!is_null($lk_mahasiswa)) {
                $psikotest_realpath = Storage::path($psikotest_mahasiswa);
                $zip->addFile($psikotest_realpath, $base_path.'/'.'psikotest'.'/'.basename($psikotest_realpath));
            }
        }

        $zip->close();

        return response()->download($zip_master);
    }

    public function download_berkas_zip_mahasiswa($id)
    {
        $calonmahasiswa = User::findorfail($id);

        $zip = new \ZipArchive();
        $zip_master = $calonmahasiswa->no_pendaftaran.'-'.$calonmahasiswa->nama;
        $zip->open($zip_master, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        //file lk
        $lk_mahasiswa = Document::where('mahasiswa_id', $id)->value('file_lk_path');
        if(!is_null($lk_mahasiswa)){
            $lk_realpath = Storage::path($lk_mahasiswa);
            $zip->addFile($lk_realpath, 'lk'.'/'.basename($lk_realpath));
        }

        //file psikotest
        $psikotest_mahasiswa = Document::where('mahasiswa_id', $id)->value('file_psikotest_path');
        if(!is_null($lk_mahasiswa)) {
            $psikotest_realpath = Storage::path($psikotest_mahasiswa);
            $zip->addFile($psikotest_realpath, 'psikotest'.'/'.basename($psikotest_realpath));
        }
        $zip->close();

        return response()->download($zip_master);

    }
    // public function download_berkas_zip() {
    //     $zip = new \ZipArchive();
    //     $zip_master = "Dokumen mahasiswa.zip";
    //     $zip->open($zip_master, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

    //     $options = array('add_path' => 'sources/', 'remove_all_path' => false);
    //     $zip->addGlob(Storage::path('public/dokumen mahasiswa').'{pdf}', GLOB_BRACE, $options);
    //     $zip->close();

    //     return response()->download($zip_master);
    // }

}
