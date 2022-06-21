<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user) {

            // Jika Password Salah
            if (!Hash::check($request->password, $user->password)) {
                return back()->withErrors([
                    'password' => 'Password yang Anda masukan salah',
                ])->withInput();
            }

            // Jika berhasil login
            if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
                $request->session()->regenerate();

                return redirect()->intended(route('home'));
            }
        } else {
            // jika username salah
            return back()->withErrors([
                'username' => 'NIP / Nama pengguna tidak terdaftar',
            ])->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
