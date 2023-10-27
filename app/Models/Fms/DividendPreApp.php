<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DividendPreApp extends Model
{
        use HasFactory;
        use \OwenIt\Auditing\Auditable;
        protected $table = 'FMS.DIVIDEN_PRE_APPROVAL_PAYMENT';
        protected $guarded = []; 
}
