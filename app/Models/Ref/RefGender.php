<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefGender extends Model
{
    use SoftDeletes;
    protected $table = 'REF.genders';
    protected $guarded = [];
    protected $dates   = ['created_at','deleted_at','updated_at'];
}
