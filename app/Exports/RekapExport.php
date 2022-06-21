<?php

namespace App\Exports;

use App\Models\Peserta;
use App\Models\RefDiklat;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RekapExport implements FromView
{
    protected $tahun, $nama_diklat;

    function __construct($tahun, $nama_diklat)
    {
        $this->tahun = $tahun;
        $this->nama_diklat = $nama_diklat;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        if ($this->tahun) {
            if ($this->nama_diklat) {
                $diklat = RefDiklat::where('nama_diklat', $this->nama_diklat)->first();
                $data = Peserta::where('tahun', $this->tahun)->where('id_diklat', $diklat->id_diklat)->orderBy('updated_at', 'desc')->get();
            } else {
                $data = Peserta::where('tahun', $this->tahun)->orderBy('updated_at', 'desc')->get();
            }
        } else {
            if ($this->nama_diklat) {
                $diklat = RefDiklat::where('nama_diklat', $this->nama_diklat)->first();
                $data = Peserta::where('id_diklat', $diklat->id_diklat)->orderBy('updated_at', 'desc')->get();
            } else {
                $data = Peserta::orderBy('updated_at', 'desc')->get();
            }
        }

        return view('rekap.export', [
            'data' => $data,
        ]);
    }
}
