<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class HomeController extends Controller
{
    public function index()
    {
        $pengumuman = Announcement::all();
        return view('home',compact('pengumuman'));
    }
}
