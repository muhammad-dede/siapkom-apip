<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\RefDiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DiklatKuController extends Controller
{
    public function index()
    {
        $data = Peserta::where('id_pegawai', auth()->user()->pegawai->id_pegawai)->orderBy('updated_at', 'desc')->get();
        return view('diklat-ku.index', compact('data'));
    }

    public function create(Request $request)
    {
        if ($request->ajax()) {
            if ($request->id_jenis_diklat) {
                $data = RefDiklat::where('id_jenis_diklat', $request->id_jenis_diklat)->get();
                return response()->json($data);
            }
        }

        return view('diklat-ku.create');
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'id_jenis_diklat' => 'required|string',
                'id_diklat' => 'required|string',
                'tahun' => 'required|string|max:5',
                'tgl_mulai' => 'required|date',
                'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
                'tempat'    => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->toArray()]);
            }

            Peserta::create([
                'id_pegawai' => auth()->user()->pegawai->id_pegawai,
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

        return redirect()->route('diklatku.index')->with('success', 'Berhasil mendaftar!');
    }

    public function show($id)
    {
        $peserta = Peserta::findOrFail($id);
        return view('diklat-ku.show', compact('peserta'));
    }

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

        return view('diklat-ku.edit', compact('peserta'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {

            $validator = Validator::make($request->all(), [
                'id_jenis_diklat' => 'required|string',
                'id_diklat' => 'required|string',
                'tahun' => 'required|string|max:5',
                'tgl_mulai' => 'required|date',
                'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
                'tempat'    => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->toArray()]);
            }

            $peserta = Peserta::findOrFail($id);
            $peserta->update([
                'id_pegawai' => auth()->user()->pegawai->id_pegawai,
                'id_jenis_diklat' => $request->id_jenis_diklat,
                'id_diklat' => $request->id_diklat,
                'tahun' => $request->tahun,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'tempat' => $request->tempat,
            ]);

            return response()->json(['success' => 'Successfully']);
        }

        return redirect()->route('diklatku.index')->with('success', 'Berhasil disimpan!');
    }

    public function storeSertifikat(Request $request, $id)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'file_sertifikat' => 'required|max:2048|mimes:pdf',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->toArray()]);
            }

            if ($request->file('file_sertifikat')) {
                $file_sertifikat = time() . '.' . $request->file_sertifikat->extension();
                $request->file_sertifikat->move(public_path('files/sertifikat'), $file_sertifikat);
            }

            $peserta = Peserta::findOrFail($id);
            $peserta->update([
                'keterangan' => 'Diklat Selesai',
            ]);
            $peserta->sertifikat()->updateOrCreate(['id_peserta' => $peserta->id_peserta], [
                'file_sertifikat' => $file_sertifikat,
            ]);

            return response()->json(['success' => 'Successfully']);
        }

        return redirect()->route('diklatku.index')->with('success', 'Berhasil disimpan');
    }
}
