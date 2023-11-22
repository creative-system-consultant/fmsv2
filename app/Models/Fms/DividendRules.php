<?php

namespace App\Models\FMS;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DividendRules extends Model
{
    use HasFactory;
    protected $table = 'FMS.DIVIDEND_RULES';
    protected $guarded = [];
}
