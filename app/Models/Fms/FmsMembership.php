<?php

namespace App\Models\Fms;

use App\Models\Cif\CifCustomer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsMembership extends Model
{
    use HasFactory;

    protected $table   = 'FMS.MEMBERSHIP';
    protected $guarded = [];

    // Relationship
    public function fmsAccountMaster()
    {
        return $this->hasOne(FmsAccountMaster::class,'mbr_no', 'mbr_no');
    }

    public function cifCustomer()
    {
        return $this->belongsTo(CifCustomer::class, 'cif_id', 'id');
    }

    public function fmsMiscAccount()
    {
        return $this->hasOne(FmsMiscAccount::class, 'mbr_no', 'mbr_no');
    }

    public function introducerList()
    {
        return $this->hasMany(IntroducerList::class, 'mbr_no', 'mbr_no');
    }
}
