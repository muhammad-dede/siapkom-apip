<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\RefDiklat;
use App\Models\RefJenisDiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
        return view('peserta.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
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
                'id_diklat' => 'required|string',
                'nama_diklat' => $request->id_diklat == 1 ? 'required|string|max:255' : 'nullable|string|max:255',
                'tahun' => 'required|string|max:5',
                'tgl_mulai' => 'required|date',
                'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
                'tempat'    => 'required|string|max:255',
                'jam_pelatihan'    => 'required|numeric',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->toArray()]);
            }

            $diklat = RefDiklat::findOrFail($request->id_diklat);

            Peserta::create([
                'id_pegawai' => $request->id_pegawai,
                'id_jenis_diklat' => $diklat->id_jenis_diklat,
                'id_diklat' => $diklat->id_diklat,
                'nama_diklat' => $diklat->id_diklat === 1 ? strtoupper($request->nama_diklat) : $diklat->nama_diklat,
                'tahun' => $request->tahun,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'tempat' => $request->tempat,
                'jam_pelatihan' => $request->jam_pelatihan,
                'id_status' => 1,
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
        if (!$peserta) {
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
        if (!$peserta) {
            return abort('404');
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

            $peserta = Peserta::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'id_pegawai' => 'required|string',
                'id_diklat' => 'required|string',
                'nama_diklat' => $request->id_diklat == 1 ? 'required|string|max:255' : 'nullable|string|max:255',
                'tahun' => 'required|string|max:5',
                'tgl_mulai' => 'required|date',
                'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
                'tempat'    => 'required|string|max:255',
                'jam_pelatihan'    => 'required|numeric',
                'no_spt' => $peserta->realisasi ? 'required|string|max:255' : 'nullable|string|max:255',
                'file_spt' => $peserta->realisasi ? 'nullable|max:2048|mimes:pdf' : 'nullable|max:2048|mimes:pdf',
                'anggaran' => $peserta->realisasi ? 'required|numeric' : 'nullable|numeric',
                'file_sertifikat' => $peserta->sertifikat ? 'nullable|max:2048|mimes:pdf' : 'nullable|max:2048|mimes:pdf',
                'keterangan' => $peserta->keteranganTolak ? 'required|string|max:255' : 'nullable|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->toArray()]);
            }

            $diklat = RefDiklat::findOrFail($request->id_diklat);

            $peserta->update([
                'id_pegawai' => $request->id_pegawai,
                'id_jenis_diklat' => $diklat->id_jenis_diklat,
                'id_diklat' => $diklat->id_diklat,
                'nama_diklat' => $diklat->id_diklat === 1 ? strtoupper($request->nama_diklat) : $diklat->nama_diklat,
                'tahun' => $request->tahun,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
                'tempat' => $request->tempat,
                'jam_pelatihan' => $request->jam_pelatihan,
            ]);

            if ($peserta->realisasi) {
                if ($request->file('file_spt')) {
                    File::delete('public/files/spt/' . $peserta->realisasi->file_spt);
                    $file_spt = time() . '.' . $request->file_spt->extension();
                    $request->file_spt->move(public_path('files/spt'), $file_spt);
                } else {
                    $file_spt = $peserta->realisasi->file_spt;
                }

                $peserta->realisasi()->update([
                    'id_peserta' => $peserta->id_peserta,
                    'no_spt' => $request->no_spt,
                    'file_spt' => $file_spt,
                    'anggaran' => $request->anggaran,
                ]);
            }

            if ($peserta->sertifikat) {
                if ($request->file('file_sertifikat')) {
                    File::delete('public/files/sertifikat/' . $peserta->sertifikat->file_sertifikat);
                    $file_sertifikat = time() . '.' . $request->file_sertifikat->extension();
                    $request->file_sertifikat->move(public_path('files/sertifikat'), $file_sertifikat);
                } else {
                    $file_sertifikat = $peserta->sertifikat->file_sertifikat;
                }

                $peserta->sertifikat()->update([
                    'id_peserta' => $peserta->id_peserta,
                    'file_sertifikat' => $file_sertifikat,
                ]);
            }

            if ($peserta->keteranganTolak) {
                $peserta->keteranganTolak()->update([
                    'id_peserta' => $peserta->id_peserta,
                    'keterangan' => $request->keterangan,
                ]);
            }

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
        $peserta = Peserta::findOrFail($id);
        if ($peserta->id_status !== 4) {
            return abort('404');
        }

        $peserta->delete();

        return redirect()->route('peserta.index')->with('success', 'Berhasil dihapus!');
    }

    public function verifikasi(Request $request, $id)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'no_spt' => $request->id_status == 2 ? 'required|string|max:255' : 'nullable|string|max:255',
                'file_spt' => $request->id_status == 2 ? 'required|max:2048|mimes:pdf' : 'nullable|max:2048|mimes:pdf',
                'anggaran' => $request->id_status == 2 ? 'required|numeric' : 'nullable|numeric',
                'keterangan' => $request->id_status == 4 ? 'required|string|max:255' : 'nullable|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->toArray()]);
            }

            $peserta = Peserta::findOrFail($id);
            $peserta->update([
                'id_status' => $request->id_status,
            ]);

            if ($peserta->id_status == 2) {
                if ($request->file('file_spt')) {
                    $file_spt = time() . '.' . $request->file_spt->extension();
                    $request->file_spt->move(public_path('files/spt'), $file_spt);
                }

                $peserta->realisasi()->updateOrCreate(['id_peserta' => $peserta->id_peserta], [
                    'id_peserta' => $peserta->id_peserta,
                    'no_spt' => $request->no_spt,
                    'file_spt' => $file_spt,
                    'anggaran' => $request->anggaran,
                ]);
            }

            if ($peserta->id_status == 4) {
                $peserta->keteranganTolak()->updateOrCreate(['id_peserta' => $peserta->id_peserta], [
                    'id_peserta' => $peserta->id_peserta,
                    'keterangan' => $request->keterangan
                ]);
            }

            return response()->json(['success' => 'Successfully']);
        }

        return redirect()->route('peserta.index')->with('success', 'Berhasil disimpan!');
    }

    public function sertifikat(Request $request, $id)
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
                'id_status' => 3,
            ]);

            $peserta->sertifikat()->updateOrCreate(['id_peserta' => $peserta->id_peserta], [
                'file_sertifikat' => $file_sertifikat,
            ]);

            return response()->json(['success' => 'Successfully']);
        }

        return redirect()->route('peserta.index')->with('success', 'Berhasil disimpan');
    }
}
