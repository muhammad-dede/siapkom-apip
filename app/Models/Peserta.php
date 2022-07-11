<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $table = 'peserta';
    protected $primaryKey = 'id_peserta';
    public $incrementing = true;
    public $timestamps = true;

    protected $guarded = [];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

    public function jenisDiklat()
    {
        return $this->belongsTo(RefJenisDiklat::class, 'id_jenis_diklat', 'id_jenis_diklat');
    }

    public function diklat()
    {
        return $this->belongsTo(RefDiklat::class, 'id_diklat', 'id_diklat');
    }

    public function status()
    {
        return $this->belongsTo(RefStatus::class, 'id_status', 'id_status');
    }

    public function realisasi()
    {
        return $this->hasOne(Realisasi::class, 'id_peserta', 'id_peserta');
    }

    public function sertifikat()
    {
        return $this->hasOne(Sertifikat::class, 'id_peserta', 'id_peserta');
    }

    public function keteranganTolak()
    {
        return $this->hasOne(KeteranganTolak::class, 'id_peserta', 'id_peserta');
    }
}
