<?php

namespace App\Models\Fms;

use App\Models\Cif\CifCustomer;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsAccountMaster extends Model
{
    use HasFactory;

    protected $table   = 'FMS.Account_Masters';
    protected $guarded = [];

    // Functions
    public function getProductAttribute()
    {
        return DB::select(DB::raw("FMS.uf_get_product(?)", [$this->product_id]))[0]->products ?? null;
    }

    // Relationship
    public function cifCustomer()
    {
        return $this->belongsTo(CifCustomer::class, 'mbr_no', 'ref_no');
    }

    public function fmsAccountPosition()
    {
        return $this->hasOne(FmsAccountPosition::class, 'account_no', 'account_no');
    }
}
