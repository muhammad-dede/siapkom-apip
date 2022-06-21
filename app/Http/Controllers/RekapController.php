<?php

namespace App\Http\Controllers;

use App\Exports\RekapExport;
use App\Models\Peserta;
use App\Models\RefDiklat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->tahun) {
                if ($request->nama_diklat) {
                    $diklat = RefDiklat::where('nama_diklat', $request->nama_diklat)->first();
                    $data = Peserta::where('id_status', 3)->where('tahun', $request->tahun)->where('id_diklat', $diklat->id_diklat)->orderBy('updated_at', 'desc')->get();
                } else {
                    $data = Peserta::where('id_status', 3)->where('tahun', $request->tahun)->orderBy('updated_at', 'desc')->get();
                }
            } else {
                if ($request->nama_diklat) {
                    $diklat = RefDiklat::where('nama_diklat', $request->nama_diklat)->first();
                    $data = Peserta::where('id_status', 3)->where('id_diklat', $diklat->id_diklat)->orderBy('updated_at', 'desc')->get();
                } else {
                    $data = Peserta::where('id_status', 3)->orderBy('updated_at', 'desc')->get();
                }
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            if (Str::contains(Str::lower($row['tahun']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            if (Str::contains(Str::lower($row['diklat']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            if (Str::contains(Str::lower($row['pegawai']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            return false;
                        });
                    }
                })
                ->addColumn('pegawai', function ($data) {
                    return $data->pegawai->nama_pegawai;
                })
                ->addColumn('tahun', function ($data) {
                    return $data->tahun;
                })
                ->addColumn('diklat', function ($data) {
                    return $data->diklat->nama_diklat;
                })
                ->addColumn('opsi', function ($data) {
                    return '<a href="' . route('rekap.detail', $data->id_peserta) . '"class="btn btn-sm btn-info">Detail</a>';
                })
                ->rawColumns(['pegawai', 'tahun', 'diklat', 'opsi'])
                ->make(true);
        }
        return view('rekap.index');
    }

    public function show($id)
    {
        $peserta = Peserta::findOrFail($id);
        if (!$peserta || $peserta->id_status !== 3) {
            return abort('404');
        }

        return view('rekap.show', compact('peserta'));
    }

    public function export(Request $request)
    {
        return Excel::download(new RekapExport($request->tahun, $request->nama_diklat), 'Rekap-Diklat.xlsx');
    }
}
