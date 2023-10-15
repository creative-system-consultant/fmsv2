<?php

namespace App\Services\Module\Teller;

use App\Models\Cif\CifCustomer;
use DB;

class RefundAdvance
{
    public function __construct()
    {
        //
    }

    private static function getAdvanceQuery()
    {
        return CifCustomer::select(
            'cif.customers.uuid',
            'cif.customers.identity_no',
            'fms.MEMBERSHIP.ref_no',
            'cif.customers.name',
            'FMS.ACCOUNT_MASTERS.account_no',
            DB::raw('products = FMS.uf_get_product(1, FMS.ACCOUNT_MASTERS.product_id)'),
            'FMS.ACCOUNT_POSITIONS.disbursed_amount',
            'FMS.ACCOUNT_POSITIONS.prin_outstanding',
            'FMS.ACCOUNT_POSITIONS.uei_outstanding',
            'FMS.ACCOUNT_POSITIONS.advance_payment',
            'FMS.ACCOUNT_POSITIONS.bal_outstanding'
        )
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.cif_id', 'cif.customers.id')
            ->join('FMS.ACCOUNT_MASTERS', 'FMS.MEMBERSHIP.ref_no', 'FMS.ACCOUNT_MASTERS.mbr_no')
            ->join('FMS.ACCOUNT_POSITIONS', 'FMS.ACCOUNT_MASTERS.ACCOUNT_NO', 'FMS.ACCOUNT_POSITIONS.ACCOUNT_NO')
            ->where(function ($query) {
                $query->where('FMS.ACCOUNT_POSITIONS.disbursed_amount', '>', 0)
                ->orWhereNull('FMS.ACCOUNT_POSITIONS.disbursed_amount');
            })
            ->where('FMS.ACCOUNT_POSITIONS.advance_payment', '>', 0);
    }

    public static function getAdvanceDetails($accountNo)
    {
        return self::getAdvanceQuery()->where('FMS.ACCOUNT_MASTERS.account_no', $accountNo)->first();
    }

    public static function getAdvanceList($search_by, $search)
    {
        return self::getAdvanceQuery()
            ->where($search_by, 'like', '%' . $search . '%')
            ->paginate(10);
    }
}