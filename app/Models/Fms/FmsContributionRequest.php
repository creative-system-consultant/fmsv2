<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsContributionRequest extends Model
{
    use HasFactory;
    protected $table = 'FMS.CONTRIBUTION_REQ_HISTORY';
    protected $guarded = [];

}
