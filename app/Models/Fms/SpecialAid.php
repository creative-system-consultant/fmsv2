<?php

namespace App\Models\Fms;

use App\Models\Fms\FmsMembership;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialAid extends Model
{
    use HasFactory;
    protected $table   = 'FMS.SPECIAL_AID_REQ_HISTORY';
    protected $guarded = [];

    public function members()
    {
        return $this->belongsTo(FmsMembership::class, 'mbr_no', 'mbr_no');
    }
}
