<?php

namespace App\Models\Cif;

use App\Models\Fms\FmsAccountMaster;
use App\Models\Fms\FmsMembership;
use App\Models\Ref\RefState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CifCustomer extends Model
{
    use HasFactory;

    protected $connection = 'fms';
    protected $table   = 'CIF.Customers';
    protected $guarded = [];

    public function fmsMembership()
    {
        return $this->hasOne(FmsMembership::class, 'cif_id', 'id');
    }

    // public function fmsAccountMaster()
    // {
    //     return $this->hasMany(FmsAccountMaster::class, 'mbr_no', 'ref_no');
    // }

    public function addresses()
    {
        return $this->hasMany(Address::class, 'cust_id', 'id');
    }
}
