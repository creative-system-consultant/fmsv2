<?php

namespace App\Services\Module\General;

use App\Models\Cif\CifCustomer;

class CustomerSearch
{
    public static function getData(
        $searchBy = null,
        $search = null
    ) {
        $query = CifCustomer::select(
                'CIF.CUSTOMERS.uuid',
                'CIF.CUSTOMERS.staff_no',
                'CIF.CUSTOMERS.identity_no',
                'FMS.MEMBERSHIP.ref_no',
                'CIF.CUSTOMERS.name',
            )
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.cif_id', 'CIF.CUSTOMERS.id')
            ->whereNotNull('FMS.MEMBERSHIP.ref_no')
            ->where('FMS.MEMBERSHIP.status_id', '<>', 4)
            ->where('CIF.CUSTOMERS.name', 'NOT LIKE', '%Administrator%');

        if ($search && $searchBy) {
            $query->where($searchBy, 'like', '%' . $search . '%');
        }

        return $query->paginate(10);
    }
}