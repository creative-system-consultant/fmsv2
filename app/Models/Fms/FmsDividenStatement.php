<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsDividenStatement extends Model
{
    use HasFactory;

    protected $table   = 'FMS.DIVIDEN_STATEMENT';
    protected $guarded = [];
}
