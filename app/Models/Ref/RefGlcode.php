<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefGlcode extends Model
{
    protected $table   = 'ref.gl_codes';
    protected $guarded = [];
    protected $dates   = ['created_at','updated_at','created_by','updated_by'];
}
