<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefRace extends Model
{
    use SoftDeletes;

    protected $table   = 'REF.RACES';
    protected $guarded = [];
    protected $dates   = ['created_at', 'deleted_at', 'updated_at'];
}
