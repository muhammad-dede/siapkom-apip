<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefJenisJabatan extends Model
{
    use HasFactory;

    protected $table = 'ref_jenis_jabatan';
    protected $primaryKey = 'id_jenis_jabatan';
    public $incrementing = true;
    public $timestamps = false;

    protected $guarded = [];

    public function jabatan()
    {
        return $this->hasMany(RefJabatan::class, 'id_jenis_jabatan', 'id_jenis_jabatan');
    }
}
