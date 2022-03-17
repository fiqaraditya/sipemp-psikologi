<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() {
        return view('register');
    }

    public function store(Request $request) {
        $validateUser = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' => 'required|min:8',
            'role' => 'required'
        ]);


        User::create($validateUser);
        /*
        auth()->login($user);*/
        return redirect('/login');

    }
}
