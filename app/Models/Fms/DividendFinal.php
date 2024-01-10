<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DividendFinal extends Model
{
    use HasFactory;
    // use \OwenIt\Auditing\Auditable;

    protected $table = 'FMS.dividend_final';

    protected $guarded = [];

    public function Customer(){
        return $this->belongsTo('App\Models\Customer', 'mbr_no', 'mbr_no');
    }
}
