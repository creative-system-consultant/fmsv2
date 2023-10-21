<?php

namespace App\Services\Module\General;

use App\Models\Cif\CifCustomer;
use DB;

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
                'FMS.MEMBERSHIP.mbr_no',
                'CIF.CUSTOMERS.name',
            )
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.cif_id', 'CIF.CUSTOMERS.id')
            ->whereNotNull('FMS.MEMBERSHIP.mbr_no')
            ->where('FMS.MEMBERSHIP.status_id', '<>', 4)
            ->where('CIF.CUSTOMERS.name', 'NOT LIKE', '%Administrator%');

        if ($search && $searchBy) {
            $query->where($searchBy, 'like', '%' . $search . '%');
        }

        return $query->paginate(10);
    }

    public static function getFinancingRepaymentData(
        $searchBy = null,
        $search = null
    ) {
        $query = CifCustomer::select(
            'CIF.CUSTOMERS.uuid',
            'CIF.CUSTOMERS.name',
            'CIF.CUSTOMERS.identity_no',
            'CIF.CUSTOMERS.id as user_id',
            'CIF.CUSTOMERS.phone',
            'CIF.CUSTOMERS.email',
            'FMS.MEMBERSHIP.mbr_no',
            'FMS.MEMBERSHIP.total_contribution',
            'FMS.ACCOUNT_MASTERS.account_no',
            'FMS.ACCOUNT_MASTERS.instal_amount',
            'FMS.ACCOUNT_MASTERS.approved_limit',
            'FMS.ACCOUNT_POSITIONS.instal_arrears',
            DB::connection('siskop')->raw('SISKOPv3B.SISKOP.Account_Products.name as product')
        )
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.cif_id', 'CIF.CUSTOMERS.id')
            ->join('FMS.ACCOUNT_MASTERS', 'FMS.ACCOUNT_MASTERS.mbr_no', 'FMS.MEMBERSHIP.mbr_no')
            ->leftJoin('FMS.ACCOUNT_POSITIONS', 'FMS.ACCOUNT_POSITIONS.account_no', 'FMS.ACCOUNT_MASTERS.account_no')
            ->join(DB::connection('siskop')->raw('SISKOPv3B.SISKOP.Account_Products'), 'SISKOPv3B.SISKOP.Account_Products.id', '=', 'FMS.ACCOUNT_MASTERS.product_id')
            ->whereIn('FMS.ACCOUNT_MASTERS.account_status', [1, 7, 8, 10])
            ->where('FMS.ACCOUNT_POSITIONS.bal_outstanding', '>', 0)
            ->where('FMS.ACCOUNT_POSITIONS.disbursed_amount', '>', 0);  // delete this once live

        if ($search && $searchBy) {
            $query->where($searchBy, 'like', '%' . $search . '%');
        }

        return $query->paginate(10);
    }

    public static function getEarlySettlementPaymentData(
        $searchBy = null,
        $search = null
    ) {
        $query = CifCustomer::select(
                'CIF.CUSTOMERS.uuid',
                'CIF.CUSTOMERS.name',
                'CIF.CUSTOMERS.identity_no',
                'CIF.CUSTOMERS.id as user_id',
                'FMS.MEMBERSHIP.mbr_no',
                'FMS.MEMBERSHIP.last_purchase_amount',
                'FMS.ACCOUNT_MASTERS.account_no',
                'FMS.ACCOUNT_MASTERS.instal_amount',
                'FMS.ACCOUNT_MASTERS.approved_limit',
                'FMS.ACCOUNT_POSITIONS.bal_outstanding',
                DB::connection('siskop')->raw('SISKOPv3B.SISKOP.Account_Products.name as product')
            )
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.cif_id', 'CIF.CUSTOMERS.id')
            ->join('FMS.ACCOUNT_MASTERS', 'FMS.ACCOUNT_MASTERS.mbr_no', 'FMS.MEMBERSHIP.mbr_no')
            ->join('FMS.ACCOUNT_POSITIONS', 'FMS.ACCOUNT_POSITIONS.account_no', 'FMS.ACCOUNT_MASTERS.account_no')
            ->join(DB::connection('siskop')->raw('SISKOPv3B.SISKOP.Account_Products'), 'SISKOPv3B.SISKOP.Account_Products.id', '=', 'FMS.ACCOUNT_MASTERS.product_id')
            ->whereIn('FMS.ACCOUNT_MASTERS.account_status', [1, 10])
            ->whereNotNull('FMS.ACCOUNT_MASTERS.early_settle_date')
            ->where('FMS.ACCOUNT_MASTERS.early_settle_date', '>=', now()->format('Y-m-d'))
            ->where('FMS.ACCOUNT_POSITIONS.bal_outstanding', '>', 0);

        if ($search && $searchBy) {
            $query->where($searchBy, 'like', '%' . $search . '%');
        }

        return $query->paginate(10);
    }

    public static function getWithdrawShareData(
        $searchBy = null,
        $search = null
    ) {
        $query = CifCustomer::select(
                'CIF.CUSTOMERS.uuid',
                'CIF.CUSTOMERS.name',
                'FMS.MEMBERSHIP.mbr_no',
                'FMS.MEMBERSHIP.total_share',
                'FMS.MEMBERSHIP.last_payment_date',
            )
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.cif_id', 'CIF.CUSTOMERS.id')
            ->where('FMS.MEMBERSHIP.total_share', '>', 500);

        if ($search && $searchBy) {
            $query->where($searchBy, 'like', '%' . $search . '%');
        }

        return $query->paginate(10);
    }

    public static function getAllCloseMembership(
        $searchBy = null,
        $search = null
    )
    {
        $query = CifCustomer::select([
            'CIF.CUSTOMERS.uuid',
            'CIF.CUSTOMERS.name',
            'CIF.CUSTOMERS.identity_no',
            'FMS.MEMBERSHIP.mbr_no',
        ])
        ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.cif_id', '=', 'CIF.CUSTOMERS.id')
        ->where(function ($query) {
            $query->where('FMS.MEMBERSHIP.retirement_flag', 0)
            ->orWhereNull('FMS.MEMBERSHIP.retirement_flag');
        })
        ->whereNotNull('FMS.MEMBERSHIP.effective_retirement_date')
        ->where('FMS.MEMBERSHIP.status_id', '!=', 4);

        if ($search && $searchBy) {
            $query->where($searchBy, 'like', '%' . $search . '%');
        }

        return $query->paginate(10);
    }

    public static function getCloseMembership($uuid)
    {
        $query = CifCustomer::select([
            'CIF.CUSTOMERS.uuid',
            'CIF.CUSTOMERS.name',
            'CIF.CUSTOMERS.identity_no',
            'CIF.CUSTOMERS.bank_id',
            'CIF.CUSTOMERS.bank_acct_no',
            'm.mbr_no',
            DB::raw('ISNULL(total_contribution, 0) AS total_contribution'),
            DB::raw('ISNULL(total_share, 0) AS total_share'),
            DB::raw('ISNULL(m.advance_payment, 0) AS advance_payment'),
            DB::raw('ISNULL(misc_amt, 0) AS misc_amt'),
            DB::raw('ISNULL(bal_dividen, 0) AS bal_dividen')
        ])
        ->join('FMS.MEMBERSHIP as fm', 'fm.cif_id', '=', 'CIF.CUSTOMERS.id')
        ->leftJoin(DB::raw('(
                SELECT
                    SUM(p.advance_payment) AS advance_payment,
                    m.mbr_no,
                    m.account_no
                FROM
                    fms.account_masters m
                INNER JOIN
                    fms.ACCOUNT_POSITIONS p ON m.account_no = p.account_no
                WHERE
                    ISNULL(p.advance_payment, 0) > 0
                    AND ISNULL(p.bal_outstanding, 0) = 0
                GROUP BY
                    m.mbr_no,
                    m.account_no
            ) AS m'), 'm.mbr_no', '=', 'fm.mbr_no')
        ->leftJoin('FMS.MISC_ACCOUNT as i', 'i.mbrno', '=', 'fm.mbr_no')
        ->leftJoin('FMS.DIVIDEND_FINAL as d', 'd.mbr_no', '=', 'fm.mbr_no')
        ->where('CIF.CUSTOMERS.uuid', $uuid)
        ->first();

        return $query;
    }
}