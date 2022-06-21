<?php

namespace App\Http\Controllers;

use App\Models\RefDiklat;
use Illuminate\Http\Request;

class DiklatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RefDiklat::orderBy('id_jenis_diklat', 'asc')->get();
        return view('diklat.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('diklat.create');
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
            'id_jenis_diklat' => 'required|string',
            'nama_diklat' => 'required|string|max:255|unique:ref_diklat,nama_diklat'
        ]);

        RefDiklat::create([
            'id_jenis_diklat' => $request->id_jenis_diklat,
            'nama_diklat' => $request->nama_diklat,
        ]);

        return redirect()->route('diklat.index')->with('success', 'Berhasil disimpan!');
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
        $diklat = RefDiklat::findOrFail($id);
        return view('diklat.edit', compact('diklat'));
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
            'id_jenis_diklat' => 'required|string',
            'nama_diklat' => 'required|string|max:255|unique:ref_diklat,nama_diklat,' . $id . ',id_diklat'
        ]);

        $diklat = RefDiklat::findOrFail($id);
        if (!$diklat) {
            return abort('404');
        }

        $diklat->update([
            'id_jenis_diklat' => $request->id_jenis_diklat,
            'nama_diklat' => $request->nama_diklat,
        ]);

        return redirect()->route('diklat.index')->with('success', 'Berhasil disimpan!');
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
