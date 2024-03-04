<?php

namespace App\Models\Siskop;

use App\Models\Fms\FmsMembership;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiskopApplyDividend extends Model
{
    use HasFactory;

    protected $table = 'SISKOP.APPLY_DIVIDEND';
    protected $guarded = [];

    public function fmsMembership()
    {
        return $this->belongsTo(FmsMembership::class, 'mbr_no', 'mbr_no');
    }
}
