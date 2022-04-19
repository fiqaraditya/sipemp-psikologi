<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use Illuminate\Http\Request;
use App\Models\Recommendation;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\InterviewSchedule;


class JadwalController extends Controller
{
    public function index()
    {
        
        if (auth()->user()->role =="admin") {
            $schedules = InterviewSchedule::orderBy('tanggal','DESC')->orderBy('waktu_mulai','ASC')->orderBy('waktu_akhir','ASC')->get();
        } else if(auth()->user()->role =="calon mahasiswa"){
            $interview = Interview::where('email_mahasiswa','=',auth()->user()->email)->get()->first();
            $schedules = InterviewSchedule::orderBy('tanggal','DESC')->orderBy('waktu_mulai','ASC')->orderBy('waktu_akhir','ASC')->where('id','=',$interview->id)->get();
        } else{
            $interview = Interview::where('email_pw_1','=',auth()->user()->email)->orWhere('email_pw_2','=',auth()->user()->email)->get(); //bentuk array multiple data
            $schedules = InterviewSchedule::orderBy('tanggal','DESC')->orderBy('waktu_mulai','ASC')->orderBy('waktu_akhir','ASC');
            foreach ($interview as $int) {
                $schedules->orWhere('id','=',$int->id);
            }
            $schedules = $schedules->get();
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
        // Announcement::create([
        //     'judul' => $request->judul,
        //     'isi' => $request->isi,
        //     'admin_id' => auth()->user()->id
        // ]);
        $InterviewSchedule = InterviewSchedule::create([
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_akhir' => $request->waktu_akhir,
        ]);

        Interview::create([
            'schedule_id' => $InterviewSchedule->id,
            'email_mahasiswa' => $request->mahasiswa,
        ]);

        // dd($InterviewSchedule->id);
        return redirect()->route('detail_jadwal_wawancara', ['id' => $InterviewSchedule->id]);
        // return redirect('daftar-jadwal-wawancara')->with('success', 'Jadwal berhasil ditambahkan, silakan input pewawancara');
    }

    public function hapus_wawancara($id) {
        // dd("test");
        Interview::where('schedule_id','=',$id)->delete();
        InterviewSchedule::where('id','=',$id)->delete();

        return redirect('daftar-jadwal-wawancara')->with('success', 'Jadwal berhasil dihapus');

    }

    public function edit($id) {
        $schedule = InterviewSchedule::where('id','=',$id)->get()->first();
        // dd($schedule);
        $interview = Interview::where('schedule_id','=',$id)->get()->first();
        $user = User::where('email','=',$interview->email_mahasiswa)->get()->first();
        $pemberi_rekomendasi = Recommendation::where('mahasiswa_key','=',$user->no_pendaftaran)->get();
        $same_hour = InterviewSchedule::where('tanggal','=',$schedule->tanggal)->where('waktu_mulai','=',$schedule->waktu_mulai)->get();
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
        $role = auth()->user()->role;


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
