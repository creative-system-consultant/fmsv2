<?php

namespace App\Models\Fms;

use App\Models\Fms\FmsMembership;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialAid extends Model
{
    use HasFactory;
    protected $table   = 'FMS.SPECIAL_AID';
    protected $guarded = [];

    public function Customer()
    {
        return $this->belongsTo(FmsMembership::class, 'mbr_no', 'mbr_no');
    }
}
