<?php

namespace App\Http\Controllers;

use App\Models\Recommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class RecommendationController extends Controller
{
    public function create_rekomendasi()
    {
        return view('submit3');
    }

    public function store_rekomendasi(Request $request)
    {
        

        if($_FILES['file']['size'] == 0){
            return redirect('submit-file-3');
        }
        else{
            $email_pr = $request->email_pr;
            $mahasiswa_key = $request->kode_unik_mahasiswa;
            $no_telp = $request->no_telp;
            $id = DB::table('users')->where('no_pendaftaran', $mahasiswa_key)->first()->id;
            $request->validate([
                'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip'
            ]);
            
            $filepath = Storage::putFile(
                'public/recommendation',
                $request->file('file'));
                
            DB::table('Recommendations')->where('email_pr', $email_pr)
                                        ->Where('mahasiswa_key', $mahasiswa_key)
                                        ->update(['notelp_pr' => $no_telp,
                                                'file_path' => $filepath
            ]);
            $id_rekomendasi = DB::table('Recommendations')->where('email_pr', $email_pr)->Where('mahasiswa_key', $mahasiswa_key)->get()->first()->id;
            $pen = DB::table('Documents')->where('mahasiswa_id', $id)->get()->first();
            if ($pen->email_pr1 == $email_pr) {
                DB::table('Documents')->where('mahasiswa_id', $id)->update(['r1_id' => $id_rekomendasi]);
            } elseif ($pen->email_pr2 == $email_pr) {
                DB::table('Documents')->where('mahasiswa_id', $id)->update(['r2_id' => $id_rekomendasi]);
            } else {
                return redirect('submit-file-3');
            }
            
            // DB::table('Documents')->where('email_pr', $email_pr)
            //                             ->orWhere('mahasiswa_id', $id)
            //                             ->update(['notelp_pr' => $no_telp,
            //                                     'file_path' => $filepath
            //                             ]);

            
           

            return redirect('pengumuman')->with('success', 'Pengumuman berhasil ditambahkan');
        }
    }
}