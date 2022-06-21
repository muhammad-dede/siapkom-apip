<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefStatus extends Model
{
    use HasFactory;

    protected $table = 'ref_status';
    protected $primaryKey = 'id_status';
    public $incrementing = true;
    public $timestamps = false;

    protected $guarded = [];
}
