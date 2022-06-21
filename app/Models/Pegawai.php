<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';
    public $incrementing = true;
    public $timestamps = false;

    protected $guarded = [];

    public function pangkat()
    {
        return $this->belongsTo(RefPangkat::class, 'id_pangkat', 'id_pangkat');
    }

    public function golongan()
    {
        return $this->belongsTo(RefGolongan::class, 'id_golongan', 'id_golongan');
    }

    public function jabatan()
    {
        return $this->belongsTo(RefJabatan::class, 'id_jabatan', 'id_jabatan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
