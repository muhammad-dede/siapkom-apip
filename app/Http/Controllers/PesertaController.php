<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\RefDiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Peserta::with(['pegawai', 'jenisDiklat', 'diklat'])->where('id_status', 1)->orderBy('created_at', 'desc')->get();
        return view('peserta.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            if ($request->id_jenis_diklat) {
                $data = RefDiklat::where('id_jenis_diklat', $request->id_jenis_diklat)->get();
                return response()->json($data);
            }
        }

        return view('peserta.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'id_pegawai' => 'required|string',
                'tahun' => 'required|string|max:5',
                'id_jenis_diklat' => 'required|string',
                'id_diklat' => 'required|string',
                'tgl_mulai' => 'required|date',
                'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
                'tempat'    => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->toArray()]);
            }

            Peserta::create([
                'id_pegawai' => $request->id_pegawai,
                'id_jenis_diklat' => $request->id_jenis_diklat,
                'id_diklat' => $request->id_diklat,
                'tahun' => $request->tahun,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'tempat' => $request->tempat,
                'id_status' => 1,
                'keterangan' => 'Verifikasi Pendaftaran',
            ]);

            return response()->json(['success' => 'Successfully']);
        }

        return redirect()->route('peserta.index')->with('success', 'Berhasil mendaftar!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $peserta = Peserta::findOrFail($id);
        if (!$peserta || $peserta->id_status !== 1) {
            return abort('404');
        }

        return view('peserta.show', compact('peserta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $peserta = Peserta::findOrFail($id);
        if (!$peserta || $peserta->id_status !== 1) {
            return abort('404');
        }

        if ($request->ajax()) {
            if ($request->id_jenis_diklat) {
                $data = RefDiklat::where('id_jenis_diklat', $request->id_jenis_diklat)->get();
                return response()->json($data);
            }
        }

        return view('peserta.edit', compact('peserta'));
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
        if ($request->ajax()) {

            $validator = Validator::make($request->all(), [
                'id_pegawai' => 'required|string',
                'tahun' => 'required|string|max:5',
                'id_jenis_diklat' => 'required|string',
                'id_diklat' => 'required|string',
                'tgl_mulai' => 'required|date',
                'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
                'tempat'    => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->toArray()]);
            }

            $peserta = Peserta::findOrFail($id);
            $peserta->update([
                'id_pegawai' => $request->id_pegawai,
                'id_jenis_diklat' => $request->id_jenis_diklat,
                'id_diklat' => $request->id_diklat,
                'tahun' => $request->tahun,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'tempat' => $request->tempat,
            ]);

            return response()->json(['success' => 'Successfully']);
        }

        return redirect()->route('peserta.index')->with('success', 'Berhasil disimpan!');
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

    public function terima(Request $request, $id)
    {
        $peserta = Peserta::findOrFail($id);
        $peserta->update([
            'id_status' => 2,
            'keterangan' => 'Diproses',
        ]);

        return redirect()->route('peserta.index')->with('success', 'Berhasil disimpan!');
    }

    public function tolak(Request $request, $id)
    {
        if ($request->ajax()) {

            $validator = Validator::make($request->all(), [
                'keterangan' => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->toArray()]);
            }

            $peserta = Peserta::findOrFail($id);
            $peserta->update([
                'id_status' => 4,
                'keterangan' => $request->keterangan,
            ]);

            return response()->json(['success' => 'Successfully']);
        }

        return redirect()->route('peserta.index')->with('success', 'Berhasil disimpan!');
    }
}
