<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeteranganTolak extends Model
{
    use HasFactory;

    protected $table = 'keterangan_tolak';
    protected $primaryKey = 'id_keterangan_tolak';
    public $incrementing = true;
    public $timestamps = false;

    protected $guarded = [];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'id_peserta', 'id_peserta');
    }
}
