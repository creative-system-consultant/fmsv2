<?php

namespace App\Models\Fms;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntroducerList extends Model
{
    use HasFactory;

    protected $table   = 'FMS.INTRODUCER_LIST';
    protected $guarded = [];

    public function membership()
    {
        return $this->hasOne(FmsMembership::class, 'mbr_no', 'mbr_no')->where('client_id', auth()->user()->client_id);
    }

    public function introducer()
    {
        return $this->hasOne(FmsMembership::class, 'mbr_no', 'introducer_mbr_no')->where('client_id', auth()->user()->client_id);
    }
}
