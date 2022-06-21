<?php

namespace App\Exports;

use App\Models\Pegawai;
use App\Models\RefJabatan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PegawaiExport implements FromView
{
    protected $nama_jabatan;

    function __construct($nama_jabatan)
    {
        $this->nama_jabatan = $nama_jabatan;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        if ($this->nama_jabatan) {
            $jabatan = RefJabatan::where('nama_jabatan', $this->nama_jabatan)->first();
            if ($jabatan) {
                $data = Pegawai::where('id_jabatan', $jabatan->id_jabatan)->get();
            } else {
                $data = Pegawai::all();
            }
        } else {
            $data = Pegawai::all();
        }

        return view('pegawai.export', [
            'data' => $data,
        ]);
    }
}
