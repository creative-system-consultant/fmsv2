<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsRepaymentSchedule extends Model
{

    use HasFactory;
    protected $table   = 'FMS.REPAYMENT_SCHEDULES';
    protected $guarded = [];
}
