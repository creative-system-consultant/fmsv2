<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefConceptCodes extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table   = 'REF.CONCEPT_CODES';
    protected $guarded = [];
    protected $dates   = ['created_at', 'deleted_at', 'updated_at'];
}
