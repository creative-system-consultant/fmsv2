<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsAccountStatement extends Model
{
    use HasFactory;

    protected $table   = 'FMS.ACCOUNT_STATEMENTS';
    protected $guarded = [];
}
