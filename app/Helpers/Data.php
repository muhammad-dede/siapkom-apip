<?php

use App\Models\Pegawai;
use App\Models\Peserta;
use App\Models\RefDiklat;
use App\Models\RefGolongan;
use App\Models\RefJabatan;
use App\Models\RefJenisDiklat;
use App\Models\RefJenisJabatan;
use App\Models\RefPangkat;
use App\Models\RefStatus;
use App\Models\Role;

function getRole()
{
    return Role::where('id_role', '!=', 3)->orderBy('id_role', 'desc')->get();
}

function refStatus()
{
    return RefStatus::orderBy('id_status', 'asc')->get();
}

function refPangkat()
{
    return RefPangkat::orderBy('nama_pangkat', 'asc')->get();
}

function refGolongan()
{
    return RefGolongan::orderBy('nama_golongan', 'asc')->get();
}

function refJenisJabatan()
{
    return RefJenisJabatan::orderBy('nama_jenis_jabatan')->get();
}

function refJabatan()
{
    return RefJabatan::orderBy('nama_jabatan', 'asc')->get();
}

function refJenisDiklat()
{
    return RefJenisDiklat::orderBy('id_jenis_diklat', 'desc')->get();
}

function refDiklat()
{
    return RefDiklat::with(['jenisDiklat'])->orderBy('nama_diklat', 'asc')->get();
}

function refDiklatByJenis($id_jenis_diklat)
{
    return RefDiklat::where('id_jenis_diklat', $id_jenis_diklat)->get();
}

function getPegawai()
{
    return Pegawai::orderBy('nama_pegawai', 'asc')->get();
}

function getTahun()
{
    $mulai = date('Y') - 5;
    $selisih = date('Y') - $mulai;
    for ($i = 0; $i <= $selisih; $i++) {
        $data[] = [
            'tahun' => ($mulai + 1) + $i,
        ];
    }

    return $data;
}

function countPeserta()
{
    return Peserta::where('id_status', 1)->count();
}

function countPesertaByStatus($id_status)
{
    return Peserta::where('id_status', $id_status)->count();
}

function getPeserta($id_status)
{
    return Peserta::where('id_status', $id_status)->orderBy('created_at', 'desc')->get();
}

function getPesertaByPegawai($id_status)
{
    return Peserta::where('id_pegawai', auth()->user()->pegawai->id_pegawai)->where('id_status', $id_status)->orderBy('created_at', 'desc')->get();
}
