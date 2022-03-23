<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengumuman = Announcement::all();
        $user = User::all();
        return view("daftar_pengumuman", compact('pengumuman','user'));
    }
       
       

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->role == "admin"){
            return view("create_pengumuman");
        }
        else{
            $pengumuman = Announcement::all();
            return view("daftar_pengumuman", compact('pengumuman'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $admin_id = auth()->user()->id;
        //dd($admin_id);

        if($_FILES['file']['size'] == 0){
           
            Announcement::create([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'admin_id' => auth()->user()->id
            ]);
        }
        else{
        
            $request->validate([
                'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip'
            ]);
    
            $filepath = Storage::putFile(
                        'public/announcements',
                        $request->file('file'));
    
            Announcement::create([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'admin_id' => auth()->user()->id,
                'file_path' => $filepath
            ]);

        }

         return redirect('pengumuman')->with('success', 'Pengumuman berhasil ditambahkan');
             
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(auth()->user()->role == "admin"){
            $pen = Announcement::findorfail($id);
            return view('update_pengumuman', compact('pen'));
        }
        else{
            $pengumuman = Announcement::all();
            return view("daftar_pengumuman", compact('pengumuman'));
        }
    }

    public function download($id)
    {
        $filepath = DB::table('announcements')->where('id',$id)->value('file_path');
        Storage::download($filepath);
        return Storage::download($filepath);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $filepath_old = DB::table('announcements')->where('id',$id)->value('file_path');

        if($_FILES['file']['size'] == 0){
            $pen = Announcement::findorfail($id);
            $pen->update($request->all());
        }
        else{
            
            $request->validate([
                'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip'
            ]);
            
            $filepath = Storage::putFile(
                'public/announcements',
                $request->file('file'));
                
                $pen = Announcement::findorfail($id);

                if(!empty($pen->file_path)){
                    Storage::delete($filepath_old);
                }

                $pen->judul = $request->judul;
                $pen->isi = $request->isi;
                $pen->file_path = $filepath;
                $pen->save();
                
        }
        
        return redirect('pengumuman')->with('success', 'Pengumuman berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth()->user()->role == "admin"){
            $pen = Announcement::findorfail($id);
            $filepath = DB::table('announcements')->where('id',$id)->value('file_path');
            $pen->delete();
            // $filepath = Announcement::select('filepath')->where('id',$id)-> pluck()->first();
            if(!empty($filepath)){
                Storage::delete($filepath);
            }
            // unlink(storage_path('public/announcements/3A2nSdjWgFnL8LEMzRkO8OsgP2t6Ny9hGfpEkHNB.docx'));
            return back()->with('info', 'Pengumuman berhasil dihapus');
        }
        else{
            $pengumuman = Announcement::all();
            return view("daftar_pengumuman", compact('pengumuman'));
        }
    }
}
