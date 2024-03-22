<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DividenRequest extends Model
{
    use HasFactory;
    // use \OwenIt\Auditing\Auditable;
    protected $table = 'FMS.DIVIDEND_REQ';
    protected $guarded = [];

}
