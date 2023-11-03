<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeMonthlyContribution extends Model
{
    use HasFactory;

    protected $table   = 'FMS.CHANGES_MONTHLY_CONTRIBUTION';
    protected $guarded = [];
}
