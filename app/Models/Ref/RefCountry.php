<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RefCountry extends Model
{
    use SoftDeletes;

    protected $table   = 'REF.COUNTRIES';
    protected $guarded = [];
    protected $dates   = ['created_at', 'deleted_at', 'updated_at'];
}
