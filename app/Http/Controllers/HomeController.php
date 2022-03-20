<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $pengumuman = Announcement::all();
        $user = User::all();
        return view('home',compact('pengumuman','user'));
    }
}
