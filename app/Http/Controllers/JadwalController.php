<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recommendation;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\InterviewSchedule;


class JadwalController extends Controller
{
    public function index()
    {
        // $admins = User::where('role', '=', 'admin')->get();
        return view("daftar_jadwal_wawancara");
    }

    public function create() {
        $calon_mahasiswa = User::orderBy('email')->where('role','=','calon mahasiswa')->get();
        // dd($calon_mahasiswa);
        return view('create_jadwal')->with('calon_mahasiswa',$calon_mahasiswa);
    }

    function fetch(Request $request){
        $select = $request->get('select');
        $value = $request->get('value');
        dd($value);
        $profesi = User::where('email','=',$value)->get();
        $dependent = $request->get('dependent');
        $data = User::orderBy('email')->where('role','=','pewawancara')->where('profesi','=',$profesi->role);
        $output = '<option value="">Select '.ucfirst($dependent).'</option>';
        
        foreach($data as $row){
            $output .= '<option value="'.$row->$dependent.'">'.$row->$dependent.'</option>';
        }
        echo $output;
    }

    public function store() {
        return view('create_jadwal');
    }
}
