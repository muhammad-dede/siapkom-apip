<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\RefDiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RealisasiController extends Controller
{
    public function index()
    {
        $data = Peserta::where('id_status', 2)->orderBy('updated_at', 'desc')->get();
        return view('realisasi.index', compact('data'));
    }

    public function edit(Request $request, $id)
    {
        $peserta = Peserta::findOrFail($id);
        if (!$peserta || $peserta->id_status !== 2) {
            return abort('404');
        }

        if ($request->ajax()) {
            if ($request->id_jenis_diklat) {
                $data = RefDiklat::where('id_jenis_diklat', $request->id_jenis_diklat)->get();
                return response()->json($data);
            }
        }

        return view('realisasi.edit', compact('peserta'));
    }

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

        return redirect()->route('realisasi.index')->with('success', 'Berhasil disimpan!');
    }


    public function show($id)
    {
        $peserta = Peserta::findOrFail($id);
        if (!$peserta || $peserta->id_status !== 2) {
            return abort('404');
        }

        return view('realisasi.show', compact('peserta'));
    }

    public function storeSPT(Request $request, $id)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'no_spt' => 'required|string|max:255',
                'file_spt' => 'required|max:2048|mimes:pdf',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->toArray()]);
            }

            if ($request->file('file_spt')) {
                $file_spt = time() . '.' . $request->file_spt->extension();
                $request->file_spt->move(public_path('files/spt'), $file_spt);
            }

            $peserta = Peserta::findOrFail($id);
            $peserta->update([
                'keterangan' => 'Proses Anggaran',
            ]);
            $peserta->realisasi()->updateOrCreate(['id_peserta' => $peserta->id_peserta], [
                'no_spt' => $request->no_spt,
                'file_spt' => $file_spt,
            ]);

            return response()->json(['success' => 'Successfully']);
        }

        return redirect()->route('realisasi.index')->with('success', 'Berhasil disimpan');
    }

    public function storeAnggaran(Request $request, $id)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'anggaran' => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->toArray()]);
            }

            $peserta = Peserta::findOrFail($id);
            $peserta->update([
                'keterangan' => 'Proses Pelaksanaan Diklat',
            ]);
            $peserta->anggaran()->updateOrCreate(['id_peserta' => $peserta->id_peserta], [
                'anggaran' => $request->anggaran,
            ]);

            return response()->json(['success' => 'Successfully']);
        }

        return redirect()->route('realisasi.index')->with('success', 'Berhasil disimpan');
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

        return redirect()->route('realisasi.index')->with('success', 'Berhasil disimpan');
    }

    public function storeSelesai(Request $request, $id)
    {
        $peserta = Peserta::findOrFail($id);
        $peserta->update([
            'id_status' => 3,
        ]);

        return redirect()->route('realisasi.index')->with('success', 'Berhasil disimpan');
    }
}
