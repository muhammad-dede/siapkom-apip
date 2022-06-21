<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    public function index()
    {
        return view('akun.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'password_old' => 'required|string|min:8',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail(auth()->user()->id_user);

        if (!Hash::check($request->password_old, $user->password)) {
            return back()->withErrors([
                'password_old' => 'Password lama salah',
            ])->withInput();
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Berhasil disimpan!');
    }
}
