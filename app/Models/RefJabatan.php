<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefJabatan extends Model
{
    use HasFactory;

    protected $table = 'ref_jabatan';
    protected $primaryKey = 'id_jabatan';
    public $incrementing = true;
    public $timestamps = false;

    protected $guarded = [];

    public function jenisJabatan()
    {
        return $this->belongsTo(RefJenisJabatan::class, 'id_jenis_jabatan', 'id_jenis_jabatan');
    }
}
