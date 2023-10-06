<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefBank extends Model
{
    use SoftDeletes;

    protected $table   = 'ref.banks';
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];
}
