<?php

namespace App\Models\Fms;

use App\Models\Ref\RefThirdParty;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsThirdPartyList extends Model
{
    use HasFactory;

    protected $table = 'FMS.THIRDPARTY_LIST';

    protected $guarded = [];

    public $timestamps = false;

    public function ThirdPartyStatment()
    {
        return $this->belongsTo(FmsThirdPartyList::class, 'institution_code', 'institution_code');
    }

    public function institution()
    {
        return $this->belongsTo(RefThirdParty::class, 'institution_code', 'id');
    }

    public function miscAcc()
    {
        return $this->belongsTo(FmsMiscAccount::class, 'mbr_no', 'mbr_no');
    }
}
