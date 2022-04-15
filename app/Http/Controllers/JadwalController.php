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
        $schedules = InterviewSchedule::orderBy('tanggal','DESC')->orderBy('waktu_mulai','ASC')->orderBy('waktu_akhir','ASC')->get();
        return view("daftar_jadwal_wawancara",compact('schedules'));
    }

    public function create() {
        $calon_mahasiswa = User::orderBy('email')->where('role','=','calon mahasiswa')->get();
        // dd($calon_mahasiswa);
        return view('create_jadwal')->with('calon_mahasiswa',$calon_mahasiswa);
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
        return redirect('daftar-jadwal-wawancara')->with('success', 'Jadwal berhasil ditambahkan, silakan input pewawancara');
    }

    public function edit($id) {
        $schedule = InterviewSchedule::where('id','=',$id)->first()->get()[0];
        // dd($schedule);
        $interview = Interview::where('schedule_id','=',$id);
        // $user = User::where('email','=',$interview->email);
        return view("detail_wawancara",compact('schedule','interview'));
    }
}
