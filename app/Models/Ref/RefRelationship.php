<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefRelationship extends Model
{
    use SoftDeletes;

    protected $table   = 'ref.relations';
    protected $guarded = [];
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];
}
