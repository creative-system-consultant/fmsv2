<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsMiscStatement extends Model
{
    use HasFactory;

    protected $table   = 'FMS.MISC_STATEMENTS';
    protected $guarded = [];
}
