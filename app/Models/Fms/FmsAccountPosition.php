<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsAccountPosition extends Model
{
    use HasFactory;

    protected $connection = 'fms';
    protected $table   = 'FMS.ACCOUNT_POSITIONS';
    protected $guarded = [];

    public function fmsAccMaster()
    {
        return $this->belongsTo(FmsAccountMaster::class, 'account_no', 'account_no');
    }
}
