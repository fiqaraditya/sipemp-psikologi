<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Recommendation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function create_lk()
    {  
        $document = Document::all();
        return view('submit1',compact('document'));
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
            Document::where('mahasiswa_id', $mahasiswa_id)->update(['file_lk_path' => $filepath]);

            return redirect('kelengkapan-berkas')->with('success', 'Berkas Lingkungan berhasil ditambahkan');
        }
    }


    public function create_psikotest()
    {
        $document = Document::all();
        return view('submit2',compact('document'));
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


            Document::where('mahasiswa_id', $mahasiswa_id)->update(['file_psikotest_path' => $filepath]);

            //$pen->update(['file_psikotest_path' => $filepath]);



            return redirect('kelengkapan-berkas')->with('success', 'Berkas Psikotest berhasil ditambahkan');
        }
    }

    public function create_email()
    {
        $document = Document::all();
        $recommendation = Recommendation::where('mahasiswa_id',auth()->user()->id)->where('mahasiswa_key',auth()->user()->no_pendaftaran)->get();
        return view('submit-email',compact('document','recommendation'));
    }

    public function store_email(Request $request)
    {
        // dd("test");
        // dd($request->all());
        $mahasiswa_id = auth()->user()->id;
        $no_pendaftaran = auth()->user()->no_pendaftaran ;
        //dd($admin_id);
        
        $pen = Document::where('mahasiswa_id', $mahasiswa_id)->firstOrFail();

        //Karena id yg jadi patokan foreign key, jadi recomendation langsung relate user (sementara based on id)
        //Cross check bagian ini (DB recomendation where mahasiswa_id <= 2)

        if($pen->email_pr1 == NULL){
            // dd($no_pendaftaran);
            //dd("a");
            //dd($request->email_pr1);
            // $pen->update(['email_pr1' => $request->email_pr1]);
            $email1 = $request->email_pr1;
            //dd($email1);
            $inputs = [
                'email_pr' => $email1,
                'mahasiswa_key' => $no_pendaftaran,
                'mahasiswa_id' => $mahasiswa_id
            ];

            Recommendation::create($inputs);

            return redirect('kelengkapan-berkas')->with('success', 'email pemberi rekomendasi berhasil ditambahkan');
        }
        elseif($pen->email_pr2 == NULL){
            //dd("b");
            //$pen->update(['email_pr2' => $request->email_pr1]);
            $email2 = $request->email_pr1;
            //dd($email2);
            Recommendation::create([
                'email_pr' => $email2,
                'mahasiswa_key' => $no_pendaftaran,
                'mahasiswa_id' => $mahasiswa_id
            ]);
            return redirect('kelengkapan-berkas')->with('success', 'email pemberi rekomendasi berhasil ditambahkan');
        }
        else{
            //dd("c");
            return redirect('kelengkapan-berkas')->with('info', 'Kapasitas Pemberi Rekomendasi Sudah Penuh');
        }
    }

    public function kelengkapan_berkas()
    {   
        $document = Document::all();
        $recommendation = Recommendation::where('mahasiswa_id',auth()->user()->id)->where('mahasiswa_key',auth()->user()->no_pendaftaran)->get();
        return view('kelengkapan_berkas',compact('document','recommendation'));
    }
}
