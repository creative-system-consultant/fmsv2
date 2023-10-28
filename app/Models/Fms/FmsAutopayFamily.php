<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsAutopayFamily extends Model
{
    use HasFactory;

    protected $connection = 'fms';
    protected $table   = 'FMS.AUTOPAY_FAMILY';
    protected $guarded = [];
}
