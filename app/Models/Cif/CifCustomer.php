<?php

namespace App\Models\Cif;

use App\Models\Fms\FmsAccountMaster;
use App\Models\Ref\RefState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CifCustomer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table   = 'CIF.Customers';
    protected $guarded = [];

    public function fmsAccountMaster()
    {
        return $this->hasMany(FmsAccountMaster::class, 'mbr_no', 'ref_no');
    }
    public function addresses()
    {
        return $this->hasMany(Address::class, 'cust_id', 'id');
    }
}
