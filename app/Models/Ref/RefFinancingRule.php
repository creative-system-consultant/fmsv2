<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;


class RefFinancingRule extends Model
{
    protected $table = 'REF.FINANCING_RULES';
    protected $guarded = [];
    protected $dates   = ['created_at', 'deleted_at', 'updated_at'];
}
