<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefGolongan extends Model
{
    use HasFactory;

    protected $table = 'ref_golongan';
    protected $primaryKey = 'id_golongan';
    public $incrementing = true;
    public $timestamps = false;

    protected $guarded = [];
}
