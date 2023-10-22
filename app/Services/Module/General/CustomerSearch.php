<?php

namespace App\Services\Module\General;

use App\Models\Cif\CifCustomer;
use App\Models\Fms\FmsThirdParty;
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
        $clientId = null,
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
            DB::raw('product = FMS.uf_get_product(' . $clientId . ', FMS.ACCOUNT_MASTERS.product_id)')
        )
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.cif_id', 'CIF.CUSTOMERS.id')
            ->join('FMS.ACCOUNT_MASTERS', 'FMS.ACCOUNT_MASTERS.mbr_no', 'FMS.MEMBERSHIP.mbr_no')
            ->leftJoin('FMS.ACCOUNT_POSITIONS', 'FMS.ACCOUNT_POSITIONS.account_no', 'FMS.ACCOUNT_MASTERS.account_no')
            ->whereIn('FMS.ACCOUNT_MASTERS.account_status', [1, 7, 8, 10])
            ->where('FMS.ACCOUNT_POSITIONS.bal_outstanding', '>', 0)
            ->where('FMS.ACCOUNT_POSITIONS.disbursed_amount', '>', 0);  // delete this once live

        if ($search && $searchBy) {
            $query->where($searchBy, 'like', '%' . $search . '%');
        }

        return $query->paginate(10);
    }

    public static function getEarlySettlementPaymentData(
        $clientId = null,
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
                DB::raw('product = FMS.uf_get_product(' . $clientId . ', FMS.ACCOUNT_MASTERS.product_id)')
            )
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.cif_id', 'CIF.CUSTOMERS.id')
            ->join('FMS.ACCOUNT_MASTERS', 'FMS.ACCOUNT_MASTERS.mbr_no', 'FMS.MEMBERSHIP.mbr_no')
            ->join('FMS.ACCOUNT_POSITIONS', 'FMS.ACCOUNT_POSITIONS.account_no', 'FMS.ACCOUNT_MASTERS.account_no')
            ->whereIn('FMS.ACCOUNT_MASTERS.account_status', [1, 10])
            ->whereNotNull('FMS.ACCOUNT_MASTERS.early_settle_date')
            ->where('FMS.ACCOUNT_MASTERS.early_settle_date', '>=', now()->format('Y-m-d'))
            ->where('FMS.ACCOUNT_POSITIONS.bal_outstanding', '>', 0);

        if ($search && $searchBy) {
            $query->where($searchBy, 'like', '%' . $search . '%');
        }

        return $query->paginate(10);
    }

    public static function getThirdPartyData(
        $clientId = null,
        $searchBy = null,
        $search = null,
    ) {
        $query = FmsThirdParty::select(
            'FMS.THIRDPARTY_LIST.id',
            'CIF.CUSTOMERS.name',
            'FMS.THIRDPARTY_LIST.transaction_amt',
            'FMS.MEMBERSHIP.total_contribution',
            'FMS.MISC_ACCOUNT.misc_amt',
            'REF.THIRDPARTY.description',
            'FMS.THIRDPARTY_LIST.mode',
            'FMS.THIRDPARTY_LIST.status',
            'FMS.THIRDPARTY_LIST.status_effective_dt',
            'FMS.THIRDPARTY_LIST.remarks',
        )
        ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.mbr_no', 'FMS.THIRDPARTY_LIST.mbr_no')
        ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', 'FMS.MEMBERSHIP.cif_id')
        ->join('REF.THIRDPARTY', 'REF.THIRDPARTY.id', 'FMS.THIRDPARTY_LIST.institution_code')
        ->join('FMS.MISC_ACCOUNT', 'FMS.MISC_ACCOUNT.mbr_no', 'FMS.THIRDPARTY_LIST.mbr_no')
        ->where('REF.THIRDPARTY.client_id', $clientId)
        ->where('flag', NULL)
        ->where('status', '<>', '2');

        if ($search && $searchBy) {
            $query->where($searchBy, 'like', '%' . $search . '%');
        }

        return $query->paginate(10);
    }

    public static function getThirdPartyIdData($id)
    {
        $query = FmsThirdParty::select(
            'FMS.THIRDPARTY_LIST.id',
            'CIF.CUSTOMERS.name',
            'CIF.CUSTOMERS.bank_id',
            'CIF.CUSTOMERS.bank_acct_no',
            'FMS.THIRDPARTY_LIST.mbr_no',
            'REF.THIRDPARTY.description',
            'FMS.THIRDPARTY_LIST.transaction_amt',
            'FMS.THIRDPARTY_LIST.mode',
            'FMS.THIRDPARTY_LIST.institution_code'
        )
        ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.mbr_no', 'FMS.THIRDPARTY_LIST.mbr_no')
        ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', 'FMS.MEMBERSHIP.cif_id')
        ->join('REF.THIRDPARTY', 'REF.THIRDPARTY.id', 'FMS.THIRDPARTY_LIST.institution_code')
        ->where('FMS.THIRDPARTY_LIST.id', $id);

        return $query->first();
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

    public static function getAllRrefundAdvance(
        $clientId = null,
        $searchBy = null,
        $search = null
    ) {
        $query = CifCustomer::select([
                'CIF.CUSTOMERS.uuid',
                'CIF.CUSTOMERS.identity_no',
                'CIF.CUSTOMERS.name',
                'FMS.MEMBERSHIP.mbr_no',
                'FMS.ACCOUNT_MASTERS.account_no',
                DB::raw('products = FMS.uf_get_product('. $clientId .', FMS.ACCOUNT_MASTERS.product_id)'),
                'FMS.ACCOUNT_POSITIONS.disbursed_amount',
                'FMS.ACCOUNT_POSITIONS.prin_outstanding',
                'FMS.ACCOUNT_POSITIONS.uei_outstanding',
                'FMS.ACCOUNT_POSITIONS.advance_payment',
                'FMS.ACCOUNT_POSITIONS.bal_outstanding'
            ])
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.cif_id', '=', 'CIF.CUSTOMERS.id')
            ->join('FMS.ACCOUNT_MASTERS', 'FMS.ACCOUNT_MASTERS.mbr_no', '=', 'FMS.MEMBERSHIP.mbr_no')
            ->join('FMS.ACCOUNT_POSITIONS', 'FMS.ACCOUNT_MASTERS.ACCOUNT_NO', 'FMS.ACCOUNT_POSITIONS.ACCOUNT_NO')
            ->where(function ($query) {
                $query->where('FMS.ACCOUNT_POSITIONS.disbursed_amount', '>', 0)
                    ->orWhereNull('FMS.ACCOUNT_POSITIONS.disbursed_amount');
            })
            ->where('FMS.ACCOUNT_POSITIONS.advance_payment', '>', 0);

        if ($search && $searchBy) {
            $query->where($searchBy, 'like', '%' . $search . '%');
        }

        return $query->paginate(10);
    }

    public static function getRrefundAdvance($accNo)
    {
        $query = CifCustomer::select([
            'CIF.CUSTOMERS.identity_no',
            'CIF.CUSTOMERS.name',
            'CIF.CUSTOMERS.bank_id',
            'CIF.CUSTOMERS.bank_acct_no',
            'FMS.ACCOUNT_MASTERS.account_no',
            'FMS.ACCOUNT_POSITIONS.advance_payment',
        ])
        ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.cif_id', '=', 'CIF.CUSTOMERS.id')
        ->join('FMS.ACCOUNT_MASTERS', 'FMS.ACCOUNT_MASTERS.mbr_no', '=', 'FMS.MEMBERSHIP.mbr_no')
        ->join('FMS.ACCOUNT_POSITIONS', 'FMS.ACCOUNT_MASTERS.ACCOUNT_NO', 'FMS.ACCOUNT_POSITIONS.ACCOUNT_NO')
        ->where(function ($query) {
            $query->where('FMS.ACCOUNT_POSITIONS.disbursed_amount', '>', 0)
                ->orWhereNull('FMS.ACCOUNT_POSITIONS.disbursed_amount');
        })
        ->where('FMS.ACCOUNT_POSITIONS.advance_payment', '>', 0)
        ->where('FMS.ACCOUNT_MASTERS.account_no', $accNo)
        ->first();

        return $query;
    }
}