<?php

namespace App\Models\Fms;

use App\Models\Ref\RefThirdParty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsThirdParty extends Model
{
    use HasFactory;

    protected $connection = 'fms';
    protected $table   = 'FMS.THIRDPARTY_LIST';
    protected $guarded = [];

    public function fmsMembership()
    {
        return $this->belongsTo(FmsMembership::class, 'mbr_no', 'mbr_no');
    }

    public function institute()
    {
        return $this->belongsTo(RefThirdParty::class, 'institution_code', 'id');
    }

    public function fmsMiscAccount()
    {
        return $this->belongsTo(FmsMiscAccount::class, 'mbr_no', 'mbr_no');
    }
}
