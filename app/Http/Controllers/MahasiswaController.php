<?php

namespace App\Http\Controllers;

use App\Mail\AnnouncementMail;
use App\Models\Document;
use App\Models\Interview;
use App\Models\InterviewSchedule;
use App\Models\User;
use App\Models\Recommendation;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Exception;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\PseudoTypes\False_;

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
        $sort = False;
        return view("daftar_mahasiswa", compact('calonmahasiswas','document','sort'));
    }

    public function index_sort()
    {
        $mahasiswa_d = User::where('role', '=', 'calon mahasiswa')->where('status_wawancara', '=', 'Disarankan')->get();
        $mahasiswa_td = User::where('role', '=', 'calon mahasiswa')->where('status_wawancara', '=', 'Tidak Disarankan')->get();
        $mahasiswa_bd = User::where('role', '=', 'calon mahasiswa')->where('status_wawancara', '=', NULL)->get();
        $document = Document::all();
        $sort = True;
        return view("daftar_mahasiswa", compact('mahasiswa_d','mahasiswa_td','mahasiswa_bd','document','sort'));
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

    public function destroy_mahasiswa_all()
    {
        // delete mahasiswa document from DB
        Document::truncate();

        // delete mahasiswa recommendation from DB
        if(Recommendation::exists()){
            Recommendation::truncate();
        }

        //delete interviews of mahasiswa from DB
        if(InterviewSchedule::exists()){
            Interview::truncate();
            InterviewSchedule::truncate();
        }

        //delete file from storage
        if(Storage::exists('public/dokumen mahasiswa')){
            $file = new Filesystem;
            $file->cleanDirectory('public/dokumen mahasiswa');
        }

        // delete user from DB
        User::where('role','calon mahasiswa')->delete();
        return redirect('daftar-mahasiswa');
    }

    public function destroy_mahasiswa($id)
    {
        $user_name = User::where('id', $id)->get()[0]->name;
        $no_pendaftaran = User::where('id', $id)->get()[0]->no_pendaftaran;
        $email = User::where('id', $id)->get()[0]->email;

        // delete mahasiswa document from DB
        Document::where('mahasiswa_id', $id)->delete();

        // delete mahasiswa recommendation from DB
        $recommendation = Recommendation::where('mahasiswa_id', $id)->first();
        if($recommendation != NULL){
            $recommendations = Recommendation::where('mahasiswa_id', $id)->get();
            foreach ($recommendations as $rec) {
                $rec->delete();
            }
        }

        //delete interviews of mahasiswa from DB
        $interview = Interview::where('email_mahasiswa',$email)->first();
        if($interview != NULL){
            $id = Interview::where('email_mahasiswa',$email)->get()[0]->id;
            Interview::where('email_mahasiswa',$email)->delete();
            InterviewSchedule::where('id', $id)->delete();
        }

        //delete file from storage
        if(Storage::exists('public/dokumen mahasiswa/'.$user_name)){
            $file = new Filesystem;
            $file->cleanDirectory('public/dokumen mahasiswa/'.$user_name);
        }
        
        // delete user from DB
        User::where('id', $id)->delete();
        return redirect('daftar-mahasiswa');
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
        $counter = 0 ;

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
                $counter++;
            }

            //file psikotest
            $psikotest_mahasiswa = Document::where('mahasiswa_id', $calonmahasiswa->id)->value('file_psikotest_path');
            if(!is_null($psikotest_mahasiswa)) {
                $psikotest_realpath = Storage::path($psikotest_mahasiswa);
                // dd($psikotest_realpath);
                $zip->addFile($psikotest_realpath, $base_path.'/'.'psikotest'.'/'.basename($psikotest_realpath));
                $counter++;
            }

            //file rekomendasi
            $rekomendasi_mahasiswa = Recommendation::where('mahasiswa_key', $calonmahasiswa->no_pendaftaran)->get();
            if(!is_null($rekomendasi_mahasiswa)) {
                foreach ($rekomendasi_mahasiswa as $rekomendasi) {
                    if(!is_null($rekomendasi->file_path)){
                        $rekomendasi_realpath = Storage::path($rekomendasi->file_path);
                        $zip->addFile($rekomendasi_realpath, $base_path.'/'.'rekomendasi'.'/'.basename($rekomendasi_realpath));
                        $counter++;
                    }
                }
            }

            //berkas wawancara
            $interview_mahasiswa = Interview::where('email_mahasiswa', $calonmahasiswa->email)->value('id');
            $wawancara_mahasiswa = InterviewSchedule::where('id',$interview_mahasiswa)->value('file_path');
            if(!is_null($wawancara_mahasiswa)){
                $wawancara_realpath = Storage::path($wawancara_mahasiswa);
                // dd($psikotest_realpath);
                $zip->addFile($wawancara_realpath, $base_path.'/'.'wawancara'.'/'.basename($wawancara_realpath));
                $counter++;
            }
        }

        if($counter!=0){
            $zip->close();
            return response()->download($zip_master);
        }
        else{
            $zip->addEmptyDir('empty');
            $zip->close();
            return redirect('daftar-mahasiswa');
        }
    }

    public function download_berkas_zip_mahasiswa($id)
    {
        $calonmahasiswa = User::findorfail($id);

        $zip = new \ZipArchive();
        $zip_master = $calonmahasiswa->no_pendaftaran.'-'.$calonmahasiswa->name.'.zip';
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

        //rekomendasi
        $rekomendasi_mahasiswa = Recommendation::where('mahasiswa_key', $calonmahasiswa->no_pendaftaran)->get();
        if(!is_null($rekomendasi_mahasiswa)) {
            foreach ($rekomendasi_mahasiswa as $rekomendasi) {
                if(!is_null($rekomendasi->file_path)){
                    $rekomendasi_realpath = Storage::path($rekomendasi->file_path);
                    // dd($rekomendasi->file_path);
                    $zip->addFile($rekomendasi_realpath, 'rekomendasi'.'/'.basename($rekomendasi_realpath));
                }
            }
        }

        //wawancara
        $interview_mahasiswa = Interview::where('email_mahasiswa', $calonmahasiswa->email)->value('id');
        $wawancara_mahasiswa = InterviewSchedule::where('id',$interview_mahasiswa)->value('file_path');
        if(!is_null($wawancara_mahasiswa)){
            $wawancara_realpath = Storage::path($wawancara_mahasiswa);
            // dd($psikotest_realpath);
            $zip->addFile($wawancara_realpath, 'wawancara'.'/'.basename($wawancara_realpath));
        }

        $zip->close();

        return response()->download($zip_master);

    }

    public function result_announcement()
    {
        $calonmahasiswas = User::where('role', '=', 'calon mahasiswa')->get();
        foreach ($calonmahasiswas as $calonmahasiswa) {
            if( $calonmahasiswa->status_penerimaan == 1) {
                $details = [
                    'title' => 'Hasil Akhir Penerimaan Calon Mahasiswa Profesi Fakultas Psikologi UI',
                    'name' => $calonmahasiswa->name,
                    'no_pendaftaran' => $calonmahasiswa->no_pendaftaran,
                    'status' => 'Diterima'
                    ];
                Mail::to($calonmahasiswa->email)->send(new AnnouncementMail($details));
            }
        }
        return redirect('daftar-mahasiswa');

    }

    public function download_user()
    {
        $calonmahasiswas = User::where('role', '=', 'calon mahasiswa')->get();
        $pdf = FacadePdf::loadView('mahasiswa_pdf',['calonmahasiswa'=>$calonmahasiswas]);
        return $pdf->download('list-calon-mahasiswa.pdf');
        
    }


}
