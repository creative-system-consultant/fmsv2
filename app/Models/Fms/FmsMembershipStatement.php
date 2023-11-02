<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsMembershipStatement extends Model
{
    use HasFactory;

    protected $table   = 'FMS.MEMBERSHIP_STATEMENTS';
    protected $guarded = [];
}
