<?php

namespace App\Models\Fms;

use App\Models\Cif\CifCustomer;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsAccountMaster extends Model
{
    use HasFactory;

    protected $table   = 'FMS.ACCOUNT_MASTERS';
    protected $guarded = [];

    // Relationship
    public function fmsMembership()
    {
        return $this->belongsTo(FmsMembership::class, 'mbr_no', 'mbr_no');
    }

    public function fmsAccountPosition()
    {
        return $this->hasOne(FmsAccountPosition::class, 'account_no', 'account_no');
    }
}
