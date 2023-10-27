<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsTrxGlMap extends Model
{
    use HasFactory;
    protected $table   = 'FMS.TRX_GL_MAP';
    protected $guarded = [];
    protected $dates   = ['created_at','updated_at','created_by','updated_by'];
}
