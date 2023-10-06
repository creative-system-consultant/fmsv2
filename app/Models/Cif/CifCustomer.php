<?php

namespace App\Models\Cif;

use App\Models\Fms\FmsAccountMaster;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CifCustomer extends Model
{
    use HasFactory;

    protected $table   = 'CIF.Customers';
    protected $guarded = [];

    public function fmsAccountMaster()
    {
        return $this->hasMany(FmsAccountMaster::class, 'mbr_no', 'ref_no');
    }
}
