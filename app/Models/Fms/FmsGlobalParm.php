<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsGlobalParm extends Model
{
    use HasFactory;

    protected $table   = 'FMS.GLOBALPARM';
    protected $guarded = [];
}
