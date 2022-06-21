<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where('id_role', '!=', 3)->where('id_user', '!=', 1)->where('id_user', '!=', auth()->user()->id_user)->get();
        return view('user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|alpha_dash|unique:user,username',
            'password' => 'required|confirmed|string|min:8',
            'id_role' => 'required|string',
        ]);

        User::create([
            'username' => strtolower($request->username),
            'password' => Hash::make($request->password),
            'nama' => $request->nama,
            'id_role' => $request->id_role,
        ]);

        return redirect()->route('user.index')->with('success', 'Berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort('404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|alpha_dash|unique:user,username,' . $id . ',id_user',
            'id_role' => 'required|string',
        ]);

        if ($request->password) {
            $request->validate([
                'password' => 'required|confirmed|string|min:8',
            ]);
        }

        $user = User::findOrFail($id);
        if (!$user) {
            return abort('404');
        }

        $user->update([
            'username' => strtolower($request->username),
            'nama' => $request->nama,
            'id_role' => $request->id_role,
        ]);

        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('user.index')->with('success', 'Berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return abort('404');
    }
}
