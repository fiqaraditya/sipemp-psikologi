<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::where('role', '=', 'admin')->orderBy('name')->get();
        return view("daftar_admin", compact('admins'));
    }

    public function create() {
        return view('create_admin');
    }

    public function store(Request $request) {
        $random_pass = Str::random(16);
        $request->request->add(['password' => $random_pass]);
        $validateUser = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email:dns', 'unique:users'],
            'role' => 'required',
            'password' => 'required|min:8',
            'profesi' => 'required'
        ]);

        $validateUser['password'] = Hash::make($validateUser['password']);
        User::create($validateUser);

        Password::sendResetLink($request->only(['email']));
        /* auth()->login($user);*/
        return redirect('/daftar-admin')->with('success', 'Admin baru berhasil didaftarkan');

    }

    public function destroy_admin($id)
    {
        User::where('id', $id)->delete();
        return redirect('daftar-admin');
    }
}
