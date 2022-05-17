<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class PewawancaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pewawancaras = User::where('role', '=', 'pewawancara')->orderBy('name')->get();
        return view("daftar_pewawancara", compact('pewawancaras'));
    }

    public function create() {
        return view('create_pewawancara');
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
        return redirect('/daftar-pewawancara')->with('success', 'Pewawancara baru berhasil didaftarkan');

    }

    public function destroy_pewawancara($id)
    {
        User::where('id', $id)->delete();
        return redirect('daftar-pewawancara');
    }

}
