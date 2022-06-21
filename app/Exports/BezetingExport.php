<?php

namespace App\Exports;

use App\Models\Bezeting;
use App\Models\RefJabatan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BezetingExport implements FromView
{
    protected $tahun, $nama_jabatan;

    function __construct($tahun, $nama_jabatan)
    {
        $this->tahun = $tahun;
        $this->nama_jabatan = $nama_jabatan;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        if ($this->tahun) {
            if ($this->nama_jabatan) {
                $jabatan = RefJabatan::where('nama_jabatan', $this->nama_jabatan)->first();
                $data = Bezeting::where('tahun', $this->tahun)->where('id_jabatan', $jabatan->id_jabatan)->with(['jabatan'])->orderBy('tahun', 'desc')->get();
            } else {
                $data = Bezeting::where('tahun', $this->tahun)->with(['jabatan'])->orderBy('tahun', 'desc')->get();
            }
        } else {
            if ($this->nama_jabatan) {
                $jabatan = RefJabatan::where('nama_jabatan', $this->nama_jabatan)->first();
                $data = Bezeting::where('id_jabatan', $jabatan->id_jabatan)->with(['jabatan'])->orderBy('tahun', 'desc')->get();
            } else {
                $data = Bezeting::with(['jabatan'])->orderBy('tahun', 'desc')->get();
            }
        }
        return view('bezeting.export', [
            'data' => $data,
        ]);
    }
}
