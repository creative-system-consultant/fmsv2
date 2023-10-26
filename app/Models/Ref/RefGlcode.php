<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefGlcode extends Model
{
    use SoftDeletes;

    protected $connection = 'fms';
    protected $table   = 'ref.glcode';
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];
}
