<?php

namespace App\Http\Controllers;

use App\Models\RefPangkat;
use Illuminate\Http\Request;

class PangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RefPangkat::orderBy('nama_pangkat', 'asc')->get();
        return view('pangkat.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pangkat.create');
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
            'nama_pangkat' => 'required|string|max:255|unique:ref_pangkat,nama_pangkat',
        ]);

        RefPangkat::create([
            'nama_pangkat' => ucwords($request->nama_pangkat),
        ]);

        return redirect()->route('pangkat.index')->with('success', 'Berhasil disimpan!');
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
        $pangkat = RefPangkat::findOrFail($id);
        return view('pangkat.edit', compact('pangkat'));
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
            'nama_pangkat' => 'required|string|max:255|unique:ref_pangkat,nama_pangkat,' . $id . ',id_pangkat',
        ]);

        $pangkat = RefPangkat::findOrFail($id);
        if (!$pangkat) {
            return abort('404');
        }

        $pangkat->update([
            'nama_pangkat' => ucwords($request->nama_pangkat),
        ]);

        return redirect()->route('pangkat.index')->with('success', 'Berhasil disimpan!');
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
