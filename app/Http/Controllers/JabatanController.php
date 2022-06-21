<?php

namespace App\Http\Controllers;

use App\Models\RefJabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RefJabatan::orderBy('nama_jabatan', 'asc')->get();
        return view('jabatan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jabatan.create');
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
            'id_jenis_jabatan' => 'required|string',
            'nama_jabatan' => 'required|string|max:255|unique:ref_jabatan,nama_jabatan',
        ]);

        RefJabatan::create([
            'id_jenis_jabatan' => $request->id_jenis_jabatan,
            'nama_jabatan' => ucwords($request->nama_jabatan),
        ]);

        return redirect()->route('jabatan.index')->with('success', 'Berhasil disimpan!');
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
        $jabatan = RefJabatan::findOrFail($id);
        return view('jabatan.edit', compact('jabatan'));
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
            'id_jenis_jabatan' => 'required|string',
            'nama_jabatan' => 'required|string|max:255|unique:ref_jabatan,nama_jabatan,' . $id . ',id_jabatan',
        ]);

        $jenjang_jabatan = RefJabatan::findOrFail($id);
        if (!$jenjang_jabatan) {
            return abort('404');
        }

        $jenjang_jabatan->update([
            'id_jenis_jabatan' => $request->id_jenis_jabatan,
            'nama_jabatan' => ucwords($request->nama_jabatan),
        ]);

        return redirect()->route('jabatan.index')->with('success', 'Berhasil disimpan!');
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
