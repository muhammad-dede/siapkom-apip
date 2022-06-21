<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bezeting extends Model
{
    use HasFactory;

    protected $table = 'bezeting';
    protected $primaryKey = 'id_bezeting';
    public $incrementing = true;
    public $timestamps = false;

    protected $guarded = [];

    public function jabatan()
    {
        return $this->belongsTo(RefJabatan::class, 'id_jabatan', 'id_jabatan');
    }
}
