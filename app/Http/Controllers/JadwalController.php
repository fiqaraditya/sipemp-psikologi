<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use Illuminate\Http\Request;
use App\Models\Recommendation;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use App\Models\InterviewSchedule;


class JadwalController extends Controller
{
    public function index()
    {
        
        if (auth()->user()->role =="admin") {
            $schedules = InterviewSchedule::orderBy('tanggal','DESC')->orderBy('waktu_mulai','ASC')->orderBy('waktu_akhir','ASC')->get();
        } else if(auth()->user()->role =="calon mahasiswa"){
            $interview = Interview::where('email_mahasiswa','=',auth()->user()->email)->get();
            if(count($interview)==0){
                $schedules = [];
            }
            else{
                $schedules = InterviewSchedule::orderBy('tanggal','DESC')->orderBy('waktu_mulai','ASC')->orderBy('waktu_akhir','ASC')->where('id','=',$interview[0]->id)->get();
            }
        } else{
            $interview = Interview::where('email_pw_1','=',auth()->user()->email)->orWhere('email_pw_2','=',auth()->user()->email)->get(); //bentuk array multiple data
            if(count($interview)==0){
               
                $schedules = [];
            }
            else{
               
                $schedules = InterviewSchedule::orderBy('tanggal','DESC')->orderBy('waktu_mulai','ASC')->orderBy('waktu_akhir','ASC');
                foreach ($interview as $int) {
                    $schedules->orWhere('id','=',$int->id);
                }
                $schedules = $schedules->get();

            }

        }
        return view("daftar_jadwal_wawancara",compact('schedules'));
    }

    public function create() {
        $existing_mahasiswa = Interview::all();
        // dd($existing_mahasiswa);
        $exist = [];
        $all = [];
        foreach ($existing_mahasiswa as $mahasiswa) {
            array_push($exist,$mahasiswa->email_mahasiswa);
        }
        $calon_mahasiswa = User::orderBy('email')->where('role','=','calon mahasiswa')->get();
        foreach ($calon_mahasiswa as $cm) {
            array_push($all,$cm->email);
        }
        $all=array_diff($all,$exist);
        // dd($calon_mahasiswa);
        return view('create_jadwal')->with('calon_mahasiswa',$all);

    }

    public function store(Request $request) {
       
        $InterviewSchedule = InterviewSchedule::create([
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_akhir' => $request->waktu_akhir,
        ]);

        Interview::create([
            'schedule_id' => $InterviewSchedule->id,
            'email_mahasiswa' => $request->mahasiswa,
        ]);

        
        return redirect()->route('detail_jadwal_wawancara', ['id' => $InterviewSchedule->id]);
    }

    public function hapus_wawancara($id) {
        // dd("test");
        Interview::where('schedule_id','=',$id)->delete();
        InterviewSchedule::where('id','=',$id)->delete();

        return redirect('daftar-jadwal-wawancara')->with('success', 'Jadwal berhasil dihapus');

    }

    public function submit_eval($id) {

        $interview = Interview::where('schedule_id','=',$id)->get()->first();
        $schedule = InterviewSchedule::where('id','=',$id)->get()->first();
        return view("submit_eval", compact('schedule','interview'));
    }

    public function downloadeval($id)
    {
        $filepath = DB::table('interview_schedules')->where('id',$id)->value('file_path');
        Storage::download($filepath);
        return Storage::download($filepath);
    }

    public function save_eval(Request $request, $id) {
        $interview = Interview::where('schedule_id','=',$id)->get()->first();
        $email = $interview->email_mahasiswa;
        $user = User::where('email','=',$email)->get()->first();

        $filepath_old = DB::table('interview_schedules')->where('id',$id)->value('file_path');

        $request->validate([
            'file' => 'required|mimes:xls,xlsx'

        ]);
            
        $filepath = Storage::putFileAs(
            'public/schedule',
            $request->file('file'),$request->file('file')->getClientOriginalName());
                
        $schedule = InterviewSchedule::findorfail($id);

        if(!empty($schedule->file_path)){
                Storage::delete($filepath_old);
        }
        $schedule->file_path = $filepath;
        $schedule->save();

        $user->status_wawancara = $request->rekomendasi;
        $user->save();

        return redirect()->route('detail_jadwal_wawancara', ['id' => $id])->with('success', 'Hasil evaluasi wawancara berhasil diubah', ['user' => $user]);
    }


    public function edit($id) {
        $schedule = InterviewSchedule::where('id','=',$id)->get()->first();
        // dd($schedule);
        $interview = Interview::where('schedule_id','=',$id)->get()->first();
        $user = User::where('email','=',$interview->email_mahasiswa)->get()->first();
        $pemberi_rekomendasi = Recommendation::where('mahasiswa_key','=',$user->no_pendaftaran)->get();
        $same_hour = InterviewSchedule::where('tanggal','=',$schedule->tanggal)->where('waktu_mulai','=',$schedule->waktu_mulai)->get();
        $existing_mahasiswa = Interview::all();
        // dd($same_hour); --> nunjukkin jadwal
        // dd($existing_mahasiswa);
        $exist = [];
        $all = [];
        foreach ($existing_mahasiswa as $mahasiswa) {
            array_push($exist,$mahasiswa->email_mahasiswa);
        }
        $calon_mahasiswa = User::orderBy('email')->where('role','=','calon mahasiswa')->get();
        foreach ($calon_mahasiswa as $cm) {
            array_push($all,$cm->email);
        }
        $all=array_diff($all,$exist);
        
        $list_pr = [];
        $pewawancara_same_hour=[];
        foreach ($pemberi_rekomendasi as $pr) {
            array_push($list_pr,$pr->email_pr);
        }
        foreach($same_hour as $hour){
            $pewawancarax = Interview::where('schedule_id','=',$hour->id)->get();
            if(count($pewawancarax) > 0){
                foreach($pewawancarax as $pewawancara){
                    if($pewawancara->email_pw_1 !=NULL && $pewawancara->email_pw_2 != NULL){
                        array_push($pewawancara_same_hour, $pewawancara->email_pw_1);
                        array_push($pewawancara_same_hour, $pewawancara->email_pw_2);
                    }
                    elseif($pewawancara->email_pw_1 !=NULL){
                        array_push($pewawancara_same_hour, $pewawancara->email_pw_1);
                    }
                    else{
                        array_push($pewawancara_same_hour, $pewawancara->email_pw_2);
                    }
                }
            }
        }
        $list_pewawancara = [];
        
        if ($interview->email_pw_1 == NULL && $interview->email_pw_2 == NULL) {
            $pewawancara = User::orderBy('email')->where('role','=','pewawancara')->where('profesi','=',$user->profesi)->get();
            $test = User::orderBy('email')->where('role','=','pewawancara')->where('profesi','=',$user->profesi)->get();
            // dd($user);
        } elseif($interview->email_pw_1 != NULL && $interview->email_pw_2 == NULL) {
            $pewawancara = User::orderBy('email')->where('role','=','pewawancara')->where('email','!=',$interview->email_pw_1)->where('profesi','=',$user->profesi)->get();

        } elseif($interview->email_pw_1 == NULL && $interview->email_pw_2 != NULL) {
            $pewawancara = User::orderBy('email')->where('role','=','pewawancara')->where('email','!=',$interview->email_pw_2)->where('profesi','=',$user->profesi)->get();
        }
        else{
            $pewawancara = User::orderBy('email')->where('role','=','pewawancara')->where('profesi','=',$user->profesi)->get();
        }

        for ($i=0; $i < count($pewawancara); $i++) {
            array_push($list_pewawancara,$pewawancara[$i]->email);
        }
        $pewawancaras = array_diff($list_pewawancara,$list_pr);
        $pewawancaras = array_diff($pewawancaras,$pewawancara_same_hour);
        $role = auth()->user()->role;

        // dd($pewawancaras);


        return view("detail_wawancara",compact('schedule','interview','user','pewawancaras','all','role'));
    }

    public function edit_pewawancara(Request $request, $id) {
        $schedule = InterviewSchedule::where('id','=',$id)->get()->first();
        $interview = Interview::where('schedule_id','=',$id)->get()->first();
        $user = User::where('email','=',$interview->email_mahasiswa)->get()->first();
        if ($interview->email_mahasiswa == $request->mahasiswa || $request->mahasiswa == NULL ) {
            if($interview->email_pw_1 == NULL && $interview->email_pw_2 == NULL){
                Interview::where('schedule_id',$id)->update(['email_pw_1'=>$request->pewawancara1]);
            }
            elseif($interview->email_pw_1 == $request->pewawancara1 && $interview->email_pw_2 == NULL){
                Interview::where('schedule_id',$id)->update(['email_pw_2'=>$request->pewawancara2]);
            }
            elseif($interview->email_pw_1 == $request->pewawancara1 && $interview->email_pw_2 == $request->pewawancara2){
                ;
            }
            elseif($interview->email_pw_1 != $request->pewawancara1 && $interview->email_pw_2 == $request->pewawancara2){
                Interview::where('schedule_id',$id)->update(['email_pw_1'=>$request->pewawancara1]);
            }
            elseif($interview->email_pw_1 == $request->pewawancara1 && $interview->email_pw_2 != $request->pewawancara2){
                Interview::where('schedule_id',$id)->update(['email_pw_2'=>$request->pewawancara2]);
            }
            elseif($interview->email_pw_1 != $request->pewawancara1 && $interview->email_pw_2 != $request->pewawancara2 && $request->pewawancara1 == $request->pewawancara2){
                ;
            }
            elseif($interview->email_pw_1 != $request->pewawancara1 && $interview->email_pw_2 != $request->pewawancara2 && $request->pewawancara1 != $request->pewawancara2){
                Interview::where('schedule_id',$id)->update(['email_pw_1'=>$request->pewawancara1,'email_pw_2'=>$request->pewawancara2]);
            }
        } else {
            if($interview->email_pw_1 == NULL && $interview->email_pw_2 == NULL){
                dd($request->mahasiswa);
                Interview::where('schedule_id',$id)->update(['email_pw_1'=>$request->pewawancara1, 'email_mahasiswa'=>$request->mahasiswa]);
            }
            elseif($interview->email_pw_1 == $request->pewawancara1 && $interview->email_pw_2 == NULL){
                // dd('2');
                Interview::where('schedule_id',$id)->update(['email_pw_2'=>$request->pewawancara2, 'email_mahasiswa'=>$request->mahasiswa]);
            }
            elseif($interview->email_pw_1 == $request->pewawancara1 && $interview->email_pw_2 == $request->pewawancara2){
                // dd('3');
                ;
            }
            elseif($interview->email_pw_1 != $request->pewawancara1 && $interview->email_pw_2 == $request->pewawancara2){
                // dd('4');
                Interview::where('schedule_id',$id)->update(['email_pw_1'=>$request->pewawancara1, 'email_mahasiswa'=>$request->mahasiswa]);
            }
            elseif($interview->email_pw_1 == $request->pewawancara1 && $interview->email_pw_2 != $request->pewawancara2){
                // dd('5');
                Interview::where('schedule_id',$id)->update(['email_pw_2'=>$request->pewawancara2, 'email_mahasiswa'=>$request->mahasiswa]);
            }
            elseif($interview->email_pw_1 != $request->pewawancara1 && $interview->email_pw_2 != $request->pewawancara2 && $request->pewawancara1 == $request->pewawancara2){
                // dd('6');
                ;
            }
            elseif($interview->email_pw_1 != $request->pewawancara1 && $interview->email_pw_2 != $request->pewawancara2 && $request->pewawancara1 != $request->pewawancara2){
                // dd('7');
                Interview::where('schedule_id',$id)->update(['email_pw_1'=>$request->pewawancara1,'email_pw_2'=>$request->pewawancara2, 'email_mahasiswa'=>$request->mahasiswa]);
            }
        }
        
        

        $user = User::where('email','=',$interview->email_mahasiswa)->get()->first();
        $pemberi_rekomendasi = Recommendation::where('mahasiswa_key','=',$user->no_pendaftaran)->get();
        $same_hour = InterviewSchedule::where('tanggal','=',$schedule->tanggal)->where('waktu_mulai','=',$schedule->waktu_mulai)->get();
        $list_pr = [];
        $pewawancara_same_hour=[];
        foreach ($pemberi_rekomendasi as $pr) {
            array_push($list_pr,$pr->email_pr);
        }
        foreach($same_hour as $hour){
            $pewawancarax = Interview::where('schedule_id','=',$hour->id)->get();
            if(count($pewawancarax)!=0){
                foreach($pewawancarax as $pewawancara){
                    if($pewawancara->email_pw_1 !=NULL && $pewawancara->email_pw_2 != NULL){
                        array_push($pewawancara_same_hour, $pewawancara->email_pw_1);
                        array_push($pewawancara_same_hour, $pewawancara->email_pw_2);
                    }
                    elseif($pewawancara->email_pw_1 !=NULL){
                        array_push($pewawancara_same_hour, $pewawancara->email_pw_1);
                    }
                    else{
                        array_push($pewawancara_same_hour, $pewawancara->email_pw_2);
                    }
                }
            }
        }
        $list_pewawancara = [];

        if ($interview->email_pw_1 == NULL && $interview->email_pw_2 == NULL) {
            $pewawancara = User::orderBy('email')->where('role','=','pewawancara')->where('profesi','=',$user->profesi)->get();
        } elseif($interview->email_pw_1 != NULL && $interview->email_pw_2 == NULL) {
            $pewawancara = User::orderBy('email')->where('role','=','pewawancara')->where('email','!=',$interview->email_pw_1)->where('profesi','=',$user->profesi)->get();

        } elseif($interview->email_pw_1 == NULL && $interview->email_pw_2 != NULL) {
            $pewawancara = User::orderBy('email')->where('role','=','pewawancara')->where('email','!=',$interview->email_pw_2)->where('profesi','=',$user->profesi)->get();
        }
        else{
            $pewawancara = User::orderBy('email')->where('role','=','pewawancara')->where('profesi','=',$user->profesi)->get();
        }

        for ($i=0; $i < count($pewawancara); $i++) {
            array_push($list_pewawancara,$pewawancara[$i]->email);
        }
        $pewawancaras = array_diff($list_pewawancara,$list_pr);
        $pewawancaras = array_diff($pewawancaras,$pewawancara_same_hour);
        $existing_mahasiswa = Interview::all();
        // dd($existing_mahasiswa);
        $exist = [];
        $all = [];
        foreach ($existing_mahasiswa as $mahasiswa) {
            array_push($exist,$mahasiswa->email_mahasiswa);
        }
        $calon_mahasiswa = User::orderBy('email')->where('role','=','calon mahasiswa')->get();
        foreach ($calon_mahasiswa as $cm) {
            array_push($all,$cm->email);
        }
        $all=array_diff($all,$exist);

        $schedule = InterviewSchedule::where('id','=',$id)->get()->first();
        $interview = Interview::where('schedule_id','=',$id)->get()->first();
        $role = auth()->user()->role;
        return redirect()->route('detail_jadwal_wawancara', ['id' => $id]);
        //return redirect('daftar-jadwal-wawancara');
    }
}
