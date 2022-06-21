<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefDiklat extends Model
{
    use HasFactory;

    protected $table = 'ref_diklat';
    protected $primaryKey = 'id_diklat';
    public $incrementing = true;
    public $timestamps = false;

    protected $guarded = [];

    public function jenisDiklat()
    {
        return $this->belongsTo(RefJenisDiklat::class, 'id_jenis_diklat', 'id_jenis_diklat');
    }
}
