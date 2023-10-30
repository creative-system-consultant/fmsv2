<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsAutopayExceptionsDetail extends Model
{
    use HasFactory;

    protected $table   = 'FMS.AUTOPAY_EXCEPTIONS_DETAIL';
    protected $guarded = [];
}
