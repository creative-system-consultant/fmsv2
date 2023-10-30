<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsAutopayRefCode extends Model
{
    use HasFactory;

    protected $table   = 'FMS.AUTOPAY_REF_CODE';
    protected $guarded = [];
}
