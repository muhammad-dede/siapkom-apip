<?php

namespace App\Http\Controllers;

use App\Exports\BezetingExport;
use App\Models\Bezeting;
use App\Models\Pegawai;
use App\Models\RefJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;

class BezetingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->tahun) {
                if ($request->nama_jabatan) {
                    $jabatan = RefJabatan::where('nama_jabatan', $request->nama_jabatan)->first();
                    $data = Bezeting::where('tahun', $request->tahun)->where('id_jabatan', $jabatan->id_jabatan)->with(['jabatan'])->orderBy('tahun', 'desc')->get();
                } else {
                    $data = Bezeting::where('tahun', $request->tahun)->with(['jabatan'])->orderBy('tahun', 'desc')->get();
                }
            } else {
                if ($request->nama_jabatan) {
                    $jabatan = RefJabatan::where('nama_jabatan', $request->nama_jabatan)->first();
                    $data = Bezeting::where('id_jabatan', $jabatan->id_jabatan)->with(['jabatan'])->orderBy('tahun', 'desc')->get();
                } else {
                    $data = Bezeting::with(['jabatan'])->orderBy('tahun', 'desc')->get();
                }
            }
            // $data = Bezeting::with(['jabatan'])->orderBy('tahun', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            if (Str::contains(Str::lower($row['tahun']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            if (Str::contains(Str::lower($row['jabatan']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            if (Str::contains(Str::lower($row['abk']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            if (Str::contains(Str::lower($row['existing']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            if (Str::contains(Str::lower($row['bezeting']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            if (Str::contains(Str::lower($row['keterangan']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            return false;
                        });
                    }
                })
                ->addColumn('tahun', function ($data) {
                    return $data->tahun;
                })
                ->addColumn('jabatan', function ($data) {
                    return $data->jabatan->nama_jabatan;
                })
                ->addColumn('abk', function ($data) {
                    return $data->abk;
                })
                ->addColumn('existing', function ($data) {
                    $existing = Pegawai::where('id_jabatan', $data->id_jabatan)->count();
                    return $existing;
                })
                ->addColumn('bezeting', function ($data) {
                    $existing = Pegawai::where('id_jabatan', $data->id_jabatan)->count();
                    return $existing - $data->abk;
                })
                ->addColumn('keterangan', function ($data) {
                    return $data->keterangan;
                })
                ->addColumn('opsi', function ($data) {
                    return '<a href="' . route('bezeting.edit', $data->id_bezeting) . '"class="btn btn-sm btn-info">Edit</a>';
                })
                ->rawColumns(['tahun', 'jabatan', 'abk', 'existing', 'bezeting', 'keterangan', 'opsi'])
                ->make(true);
        }
        return view('bezeting.index');
    }

    public function create()
    {
        return view('bezeting.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required|string',
            'id_jabatan' => 'required|string',
            'abk' => 'required|numeric',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Bezeting::create([
            'tahun' => $request->tahun,
            'id_jabatan' => $request->id_jabatan,
            'abk' => $request->abk,
            'keterangan' =>  $request->keterangan,
        ]);

        return redirect()->route('bezeting.index')->with('success', 'Berhasil disimpan');
    }

    public function edit($id)
    {
        $bezeting = Bezeting::findOrFail($id);
        return view('bezeting.edit', compact('bezeting'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun' => 'required|string',
            'id_jabatan' => 'required|string',
            'abk' => 'required|numeric',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $bezeting = Bezeting::findOrFail($id);
        $bezeting->update([
            'tahun' => $request->tahun,
            'id_jabatan' => $request->id_jabatan,
            'abk' => $request->abk,
            'keterangan' =>  $request->keterangan,
        ]);

        return redirect()->route('bezeting.index')->with('success', 'Berhasil disimpan');
    }

    public function export(Request $request)
    {
        return Excel::download(new BezetingExport($request->tahun, $request->nama_jabatan), 'Bezeting.xlsx');
    }
}
