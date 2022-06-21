<?php

namespace App\Http\Controllers;

use App\Models\RefGolongan;
use Illuminate\Http\Request;

class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RefGolongan::orderBy('nama_golongan', 'asc')->get();
        return view('golongan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('golongan.create');
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
            'nama_golongan' => 'required|string|max:255|unique:ref_golongan,nama_golongan',
        ]);

        RefGolongan::create([
            'nama_golongan' => $request->nama_golongan,
        ]);

        return redirect()->route('golongan.index')->with('success', 'Berhasil disimpan!');
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
        $golongan = RefGolongan::findOrFail($id);
        return view('golongan.edit', compact('golongan'));
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
            'nama_golongan' => 'required|string|max:255|unique:ref_golongan,nama_golongan,' . $id . ',id_golongan',
        ]);

        $golongan = RefGolongan::findOrFail($id);
        if (!$golongan) {
            return abort('404');
        }

        $golongan->update([
            'nama_golongan' => $request->nama_golongan,
        ]);

        return redirect()->route('golongan.index')->with('success', 'Berhasil disimpan!');
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
