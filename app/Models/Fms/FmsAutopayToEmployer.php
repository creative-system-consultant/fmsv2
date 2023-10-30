<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsAutopayToEmployer extends Model
{
    use HasFactory;

    protected $table   = 'FMS.AUTOPAY_TO_EMPLOYER';
    protected $guarded = [];
}
