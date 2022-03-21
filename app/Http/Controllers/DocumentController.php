<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Recommendation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function create_lk()
    {
        return view('submit1');
    }

    public function store_lk(Request $request)
    {
        // dd($request->all());
        $mahasiswa_id = auth()->user()->id;
        //dd($admin_id);

        if($_FILES['file']['size'] == 0){
            return redirect('submit-file-1');
        }
        else{
            //$pen = DB::table('Documents')->where('mahasiswa_id', $mahasiswa_id)->first();
            
            $request->validate([
                'file' => 'required|file|mimes:doc,docx,xlsx,xls,pdf,zip'
            ]);
    
            $filepath = Storage::putFile(
                        'public/lk',
                        $request->file('file'));
            
            //$pen->update(['file_lk_path' => $filepath]);
            DB::table('Documents')->where('mahasiswa_id', $mahasiswa_id)->update(['file_lk_path' => $filepath]);
            
            return redirect('kelengkapan-berkas')->with('success', 'Berkas Lingkungan berhasil ditambahkan');
        }     
    }

    public function create_psikotest()
    {
        return view('submit2');
    }

    public function store_psikotest(Request $request)
    {
        // dd($request->all());
        $mahasiswa_id = auth()->user()->id;
        //dd($admin_id);

        if($_FILES['file']['size'] == 0){
            return redirect('submit-file-2');
        }
        else{
            //$pen = DB::table('Documents')->where('mahasiswa_id', $mahasiswa_id)->first();

            $request->validate([
                'file' => 'required|file|mimes:doc,docx,xlsx,xls,pdf,zip'
            ]);
    
            $filepath = Storage::putFile(
                        'public/psikotest',
                        $request->file('file'));
            
            

            DB::table('Documents')->where('mahasiswa_id', $mahasiswa_id)->update(['file_psikotest_path' => $filepath]);

            //$pen->update(['file_psikotest_path' => $filepath]);
            

            
            return redirect('kelengkapan-berkas')->with('success', 'Berkas Psikotest berhasil ditambahkan');
        }    
    }

    public function create_rekomendasi()
    {
        return view('submit3');
    }

    public function create_email()
    {
        return view('submit-email');
    }

    public function store_email(Request $request)
    {
        // dd("test");
        // dd($request->all());
        $mahasiswa_id = auth()->user()->id;
        $no_pendaftaran = auth()->user()->no_pendaftaran ;
        //dd($admin_id);

       $pen = DB::table('Documents')->where('mahasiswa_id', $mahasiswa_id)->get()->first();
      
        if($pen->email_pr1 == NULL){
            // dd($no_pendaftaran);
            //dd("a");
            //dd($request->email_pr1);
            // $pen->update(['email_pr1' => $request->email_pr1]);
            $email1 = $request->email_pr1;
            //dd($email1);
            DB::table('Recommendations')->insert([
                'email_pr' => $email1,
                'mahasiswa_key' => $no_pendaftaran 
            ]);

            DB::table('Documents')->where('mahasiswa_id', $mahasiswa_id)->update(['email_pr1' => $email1]);
            

            return redirect('kelengkapan-berkas')->with('success', 'Pengumuman berhasil ditambahkan');
        }
        elseif($pen->email_pr2 == NULL){
            //dd("b");
            //$pen->update(['email_pr2' => $request->email_pr1]);
            $email2 = $request->email_pr1; 
            //dd($email2);
            DB::table('Recommendations')->insert([
                'email_pr' => $email2,
                'mahasiswa_key' => $no_pendaftaran 
            ]);
            DB::table('Documents')->where('mahasiswa_id', $mahasiswa_id)->update(['email_pr2' => $email2]);
            return redirect('kelengkapan-berkas')->with('success', 'Pengumuman berhasil ditambahkan');
        }
        else{
            //dd("c");
            return redirect('kelengkapan-berkas')->with('info', 'Kapasitas Pemberi Rekomendasi Sudah Penuh');
        }    
    }

    public function kelengkapan_berkas()
    {
        return view('kelengkapan_berkas');
    }
}
