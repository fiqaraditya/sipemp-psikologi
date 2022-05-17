<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Recommendation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class RecommendationController extends Controller
{
    public function create_rekomendasi()
    {
        $template = Template::all()->get();
        $template = Template::all()->first();
        return view('submit3', compact('document','template'));
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
            $peran = $request->peran;
            $id = User::where('no_pendaftaran', $mahasiswa_key)->first()->id;
            $name = User::where('no_pendaftaran', $mahasiswa_key)->first()->name;
            $peran = $request->peran;
            $request->validate([
                'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip'
            ]);
            
            $filepath = Storage::putFileAs(
                'public/dokumen mahasiswa/'.$name.'/recommendation',
                $request->file('file'),$request->file('file')->getClientOriginalName());
                
            Recommendation::where('email_pr', $email_pr)
                                        ->Where('mahasiswa_key', $mahasiswa_key)
                                        ->update(['notelp_pr' => $no_telp,
                                                'file_path' => $filepath,
                                                'peran' => $peran
            ]);

            return redirect('/')->with('success', 'Surat rekomendasi berhasil ditambahkan');
        }
    }
}