<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsThirdPartyStatement extends Model
{
    use HasFactory;

    protected $table   = 'FMS.THIRDPARTY_STATEMENTS';
    protected $guarded = [];
}
