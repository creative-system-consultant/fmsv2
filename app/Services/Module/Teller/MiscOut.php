<?php

namespace App\Services\Module\Teller;

use App\Models\Fms\FmsMiscAccount;

class MiscOut
{
    public static function getData(
        $searchBy = null,
        $search = null
    ) {
        $query = FmsMiscAccount::select(
            'FMS.MISC_ACCOUNT.mbrno',
            'CIF.CUSTOMERS.identity_no',
            'CIF.CUSTOMERS.name',
            'FMS.MISC_ACCOUNT.misc_amt'
        )
        ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.ref_no', 'FMS.MISC_ACCOUNT.mbrno')
        ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', 'FMS.MEMBERSHIP.cif_id');

        if ($search && $searchBy) {
            $query->where($searchBy, 'like', '%' . $search . '%');
        }

        return $query->paginate(10);
    }
}