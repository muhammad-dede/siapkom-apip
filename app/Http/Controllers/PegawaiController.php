<?php

namespace App\Http\Controllers;

use App\Exports\PegawaiExport;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pegawai::with(['pangkat', 'golongan', 'jabatan'])->orderBy('nama_pegawai', 'desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('nama_jabatan'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            if (Str::contains(Str::lower($row['jabatan']), Str::lower($request->get('nama_jabatan')))) {
                                return true;
                            }
                            return false;
                        });
                    }
                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            if (Str::contains(Str::lower($row['nama_pegawai']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            if (Str::contains(Str::lower($row['pangkat_golongan']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            if (Str::contains(Str::lower($row['jabatan']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            return false;
                        });
                    }
                })
                ->addColumn('pangkat_golongan', function ($data) {
                    return $data->pangkat->nama_pangkat . ' (' . $data->golongan->nama_golongan . ')';
                })
                ->addColumn('jabatan', function ($data) {
                    return $data->jabatan->nama_jabatan;
                })
                ->addColumn('opsi', function ($data) {
                    return '<a href="' . route('pegawai.edit', $data->id_pegawai) . '"class="btn btn-sm btn-info">Edit</a>';
                })
                ->rawColumns(['pangkat_golongan', 'jabatan', 'opsi'])
                ->make(true);
        }
        return view('pegawai.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawai.create');
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
            'nip' => 'required|numeric|digits_between:10,20|unique:pegawai,nip',
            'nama_pegawai' => 'required|string|max:255',
            'id_pangkat' => 'required|string',
            'id_golongan' => 'required|string',
            'id_jabatan' => 'required|string',
        ]);

        $user = User::create([
            'username' => $request->nip,
            'password' => Hash::make('12345678'),
            'nama' => ucwords($request->nama_pegawai),
            'id_role' => 3,
        ]);

        Pegawai::create([
            'nama_pegawai' => ucwords($request->nama_pegawai),
            'nip' => $request->nip,
            'id_pangkat' => $request->id_pangkat,
            'id_golongan' => $request->id_golongan,
            'id_jabatan' => $request->id_jabatan,
            'id_user' => $user->id_user,
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Berhasil disimpan');
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
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.edit', compact('pegawai'));
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
            'nama_pegawai' => 'required|string|max:255',
            'nip' => 'required|numeric|digits_between:10,20|unique:pegawai,nip,' . $id . ',id_pegawai',
            'id_pangkat' => 'required|string',
            'id_golongan' => 'required|string',
            'id_jabatan' => 'required|string',
        ]);

        $pegawai = Pegawai::findOrFail($id);
        if (!$pegawai) {
            return abort('404');
        }

        $pegawai->update([
            'nama_pegawai' => ucwords($request->nama_pegawai),
            'nip' => $request->nip,
            'id_pangkat' => $request->id_pangkat,
            'id_golongan' => $request->id_golongan,
            'id_jabatan' => $request->id_jabatan,
        ]);

        User::where('id_user', $pegawai->id_user)->update([
            'username' => $request->nip,
            'nama' => ucwords($request->nama_pegawai),
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Berhasil disimpan');
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

    public function export(Request $request)
    {
        return Excel::download(new PegawaiExport($request->nama_jabatan), 'Data-Pegawai.xlsx');
    }
}
