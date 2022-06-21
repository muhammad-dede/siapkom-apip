<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefPangkat extends Model
{
    use HasFactory;

    protected $table = 'ref_pangkat';
    protected $primaryKey = 'id_pangkat';
    public $incrementing = true;
    public $timestamps = false;

    protected $guarded = [];
}
