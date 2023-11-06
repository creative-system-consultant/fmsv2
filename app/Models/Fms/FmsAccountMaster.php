<?php

namespace App\Models\Fms;

use App\Models\Cif\CifCustomer;
use App\Models\Ref\RefConceptCodes;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsAccountMaster extends Model
{
    use HasFactory;

    protected $table   = 'FMS.ACCOUNT_MASTERS';
    protected $guarded = [];

    // Functions
    public function getProductAttribute()
    {
        $client_id = 1;
        $id_product = $this->product_id;

        $result = DB::select("DECLARE @product_name VARCHAR(50); EXEC @product_name = FMS.uf_get_product ?, ?; SELECT @product_name", [$client_id, $id_product]);

        if (!empty($result)) {
            return $result[0]->{''};
        }

        return null;
    }

    public function position()
    {
        return $this->hasOne(FmsAccountPosition::class, 'account_no', 'account_no');
    }


    public function concept()
    {
        return $this->belongsTo(RefConceptCodes::class, 'concept_id', 'id');
    }


    // Relationship
    public function membership()
    {
        return $this->belongsTo(Membership::class, 'mbr_no', 'mbr_no');
    }

    public function fmsAccountPosition()
    {
        return $this->hasOne(FmsAccountPosition::class, 'account_no', 'account_no');
    }

    public function repayment_schedule($client_id)
    {
        $relation = $this->hasMany(FmsRepaymentSchedule::class, 'account_no', 'account_no');
        $relation->where('client_id', $client_id);
        return $relation;
    }
}
