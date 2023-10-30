<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefMarital extends Model
{
    use SoftDeletes;

    protected $table = 'REF.marital';
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];
}
