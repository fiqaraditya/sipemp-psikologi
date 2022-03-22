<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::where('role', '=', 'admin')->get();
        return view("daftar_admin", compact('admins'));
    }

    public function create() {
        return view('create_admin');
    }

    public function store(Request $request) {
        $validateUser = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' => 'required|min:8',
            'role' => 'required',
            'profesi' => 'nullable'
        ]);

        User::create($validateUser);
        /* auth()->login($user);*/
        return redirect('/daftar-admin');

    }
}
