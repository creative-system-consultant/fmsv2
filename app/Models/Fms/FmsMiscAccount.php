<?php

namespace App\Models\Fms;

use App\Models\Cif\CifCustomer;
use App\Models\Ref\RefBank;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsMiscAccount extends Model
{
    use HasFactory;
    protected $table   = 'FMS.MISC_ACCOUNT';
    protected $guarded = [];
    protected $primaryKey = 'seq';

    public function membership()
    {
        return $this->belongsTo(Membership::class, 'mbr_no', 'mbr_no');
    }

    public function bank()
    {
        return $this->belongsTo(RefBank::class, 'bank_members', 'id');
    }
}
