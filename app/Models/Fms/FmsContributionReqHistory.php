<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FmsContributionReqHistory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'FMS.CONTRIBUTION_REQ_HISTORY';
    protected $guarded = [];
    protected $casts   = [
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
        'deleted_at'    => 'datetime',
    ];
}
