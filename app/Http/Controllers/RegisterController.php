<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;

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

        // auth()->login($user);
        return redirect('/login');

    }

    public function setPasswordForm($token) {
        return view('create_password', ['token' => $token]);
    }

    public function setPasswordStore(Request $request) {
        $validateUser = $request->validate([
            'token' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );
        /*
        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();*/

        return redirect('/login')->with('message', 'Your password has been changed!');
    }
}
