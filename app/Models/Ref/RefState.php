<?php

namespace App\Models\Ref;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefState extends Model
{
    use SoftDeletes;

    protected $connection = 'fms';
    protected $table   = 'ref.statecodes';
    protected $guarded = [];
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];
}
