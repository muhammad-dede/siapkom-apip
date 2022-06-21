<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefJenisDiklat extends Model
{
    use HasFactory;

    protected $table = 'ref_jenis_diklat';
    protected $primaryKey = 'id_jenis_diklat';
    public $incrementing = true;
    public $timestamps = false;

    protected $guarded = [];

    public function diklat()
    {
        return $this->hasMany(RefDiklat::class, 'id_jenis_diklat', 'id_jenis_diklat');
    }
}
