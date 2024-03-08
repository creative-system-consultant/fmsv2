<?php

namespace App\Services\Module\General;

use App\Models\Cif\CifCustomer;
use App\Models\Fms\DividendFinal;
use App\Models\Fms\FmsAccountMaster;
use App\Models\Fms\FmsContributionReqHistory;
use App\Models\Fms\FmsMiscAccount;
use App\Models\Fms\FmsShareReqHistory;
use App\Models\Fms\FmsThirdParty;
use App\Models\Siskop\SiskopApplyDividend;
use App\Models\Siskop\SiskopContribution;
use DB;

class CustomerSearch
{
    public static function getData(
        $clientId,
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
            ->where('CIF.CUSTOMERS.name', 'NOT LIKE', '%Administrator%')
            ->where('CIF.CUSTOMERS.client_id', $clientId)
            ->where('FMS.MEMBERSHIP.client_id', $clientId);

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
            ->where('FMS.ACCOUNT_POSITIONS.disbursed_amount', '>', 0); // delete this once live

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
            DB::raw('FMS.uf_get_pro_3rdparty(FMS.THIRDPARTY_LIST.client_id, FMS.THIRDPARTY_LIST.institution_code) as description'),
            'FMS.THIRDPARTY_LIST.mode',
            'FMS.THIRDPARTY_LIST.status',
            'FMS.THIRDPARTY_LIST.status_effective_dt',
            'FMS.THIRDPARTY_LIST.remarks'
        )
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.mbr_no', 'FMS.THIRDPARTY_LIST.mbr_no')
            ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', 'FMS.MEMBERSHIP.cif_id')
            ->join('FMS.MISC_ACCOUNT', 'FMS.MISC_ACCOUNT.mbr_no', 'FMS.THIRDPARTY_LIST.mbr_no')
            ->where('FMS.THIRDPARTY_LIST.client_id', $clientId)
            ->where('FMS.MEMBERSHIP.client_id', $clientId)
            ->where('CIF.CUSTOMERS.client_id', $clientId)
            ->where('FMS.MISC_ACCOUNT.client_id', $clientId)
            ->where('flag', null)
            ->where('status', '<>', '2');

        if ($search && $searchBy) {
            $query->where($searchBy, 'like', '%' . $search . '%');
        }

        return $query->paginate(10);
    }

    public static function getThirdPartyIdData($clientId, $id)
    {
        $query = FmsThirdParty::select(
            'FMS.THIRDPARTY_LIST.id',
            'CIF.CUSTOMERS.name',
            'CIF.CUSTOMERS.bank_id',
            'CIF.CUSTOMERS.bank_acct_no',
            'FMS.THIRDPARTY_LIST.mbr_no',
            DB::raw('FMS.uf_get_pro_3rdparty(FMS.THIRDPARTY_LIST.client_id, FMS.THIRDPARTY_LIST.institution_code) as description'),
            'FMS.THIRDPARTY_LIST.transaction_amt',
            'FMS.THIRDPARTY_LIST.mode',
            'FMS.THIRDPARTY_LIST.institution_code'
        )
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.mbr_no', 'FMS.THIRDPARTY_LIST.mbr_no')
            ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', 'FMS.MEMBERSHIP.cif_id')
            ->where('FMS.THIRDPARTY_LIST.id', $id)
            ->where('FMS.THIRDPARTY_LIST.client_id', $clientId)
            ->where('FMS.MEMBERSHIP.client_id', $clientId)
            ->where('CIF.CUSTOMERS.client_id', $clientId);

        return $query->first();
    }

    public static function getAllWithdrawShareData(
        $clientId,
        $searchBy = null,
        $search = null
    ) {
        $query = FmsShareReqHistory::select(
            'FMS.SHARES_REQ_HISTORY.id',
            'FMS.SHARES_REQ_HISTORY.mbr_no',
            'CIF.CUSTOMERS.name',
            'FMS.MEMBERSHIP.total_share',
            'FMS.MEMBERSHIP.last_payment_date',
            'FMS.SHARES_REQ_HISTORY.approved_amt',
            'FMS.SHARES_REQ_HISTORY.apply_amt',
        )
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.mbr_no', 'FMS.SHARES_REQ_HISTORY.mbr_no')
            ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', 'FMS.MEMBERSHIP.cif_id')
            ->where('FMS.SHARES_REQ_HISTORY.direction', 'sell')
            ->where('FMS.MEMBERSHIP.total_share', '>', 500)
            ->where('FMS.SHARES_REQ_HISTORY.req_status', 1)
            ->where('FMS.SHARES_REQ_HISTORY.client_id', $clientId)
            ->where('CIF.CUSTOMERS.client_id', $clientId)
            ->where('FMS.MEMBERSHIP.client_id', $clientId);

        if ($search && $searchBy) {
            $query->where($searchBy, 'like', '%' . $search . '%');
        }

        return $query->paginate(10);
    }

    public static function getWithdrawShareData(
        $clientId = null,
        $id = null
    ) {
        $query = FmsShareReqHistory::select(
            'FMS.SHARES_REQ_HISTORY.id',
            'FMS.SHARES_REQ_HISTORY.apply_id',
            'FMS.SHARES_REQ_HISTORY.mbr_no',
            'CIF.CUSTOMERS.name',
            'FMS.MEMBERSHIP.total_share',
            'FMS.MEMBERSHIP.last_payment_date',
            'CIF.CUSTOMERS.identity_no',
            'CIF.CUSTOMERS.bank_id',
            'CIF.CUSTOMERS.bank_acct_no',
            'FMS.SHARES_REQ_HISTORY.approved_amt',
            'FMS.SHARES_REQ_HISTORY.apply_amt',
        )
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.mbr_no', 'FMS.SHARES_REQ_HISTORY.mbr_no')
            ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', 'FMS.MEMBERSHIP.cif_id')
            ->where('FMS.SHARES_REQ_HISTORY.direction', 'sell')
            ->where('FMS.SHARES_REQ_HISTORY.id', $id)
            ->where('FMS.SHARES_REQ_HISTORY.req_status', 1)
            ->where('FMS.SHARES_REQ_HISTORY.client_id', $clientId)
            ->where('CIF.CUSTOMERS.client_id', $clientId)
            ->where('FMS.MEMBERSHIP.client_id', $clientId);

        return $query->first();
    }

    public static function getAllCloseMembership(
        $clientId,
        $searchBy = null,
        $search = null
    ) {
        $query = CifCustomer::select([
            'CIF.CUSTOMERS.uuid',
            'CIF.CUSTOMERS.name',
            'CIF.CUSTOMERS.identity_no',
            'CIF.CUSTOMERS.bank_id',
            'CIF.CUSTOMERS.bank_acct_no',
            'm.mbr_no',
            DB::raw('ISNULL(FMS.MEMBERSHIP.total_contribution, 0) AS total_contribution'),
            DB::raw('ISNULL(FMS.MEMBERSHIP.total_share, 0) AS total_share'),
            DB::raw('ISNULL(m.advance_payment, 0) AS advance_payment'),
            DB::raw('ISNULL(FMS.MISC_ACCOUNT.misc_amt, 0) AS misc_amt'),
            DB::raw('ISNULL(FMS.DIVIDEND_FINAL.bal_dividen, 0) AS bal_dividen'),
        ])
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.cif_id', '=', 'CIF.CUSTOMERS.id')
            ->leftJoin(DB::raw("(
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
                    AND m.client_id = $clientId
                    AND p.client_id = $clientId
                GROUP BY
                    m.mbr_no,
                    m.account_no
            ) AS m"), 'm.mbr_no', '=', 'FMS.MEMBERSHIP.mbr_no')
            ->leftJoin('FMS.MISC_ACCOUNT', 'FMS.MISC_ACCOUNT.mbr_no', '=', 'FMS.MEMBERSHIP.mbr_no')
            ->leftJoin('FMS.DIVIDEND_FINAL', 'FMS.DIVIDEND_FINAL.mbr_no', '=', 'FMS.MEMBERSHIP.mbr_no')
            ->where(function ($query) {
                $query->where('FMS.MEMBERSHIP.retirement_flag', 0)
                    ->orWhereNull('FMS.MEMBERSHIP.retirement_flag');
            })
            ->whereNotNull('FMS.MEMBERSHIP.effective_retirement_date')
            ->where('FMS.MEMBERSHIP.status_id', '!=', 4)
            ->whereNotNull('m.mbr_no')
            ->where('CIF.CUSTOMERS.client_id', $clientId)
            ->where('FMS.MEMBERSHIP.client_id', $clientId)
            ->where('FMS.MISC_ACCOUNT.client_id', $clientId)
            ->where('FMS.DIVIDEND_FINAL.client_id', $clientId);

        if ($search && $searchBy) {
            $query->where($searchBy, 'like', '%' . $search . '%');
        }

        return $query->paginate(10);
    }

    public static function getCloseMembership($clientId, $uuid)
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
            DB::raw('ISNULL(bal_dividen, 0) AS bal_dividen'),
        ])
            ->join('FMS.MEMBERSHIP as fm', 'fm.cif_id', '=', 'CIF.CUSTOMERS.id')
            ->leftJoin(DB::raw("(
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
                    AND m.client_id = $clientId
                    AND p.client_id = $clientId
                GROUP BY
                    m.mbr_no,
                    m.account_no
            ) AS m"), 'm.mbr_no', '=', 'fm.mbr_no')
            ->leftJoin('FMS.MISC_ACCOUNT as i', 'i.mbr_no', '=', 'fm.mbr_no')
            ->leftJoin('FMS.DIVIDEND_FINAL as d', 'd.mbr_no', '=', 'fm.mbr_no')
            ->where('CIF.CUSTOMERS.uuid', $uuid)
            ->where('CIF.CUSTOMERS.client_id', $clientId)
            ->first();

        return $query;
    }

    public static function getAllMiscellaneousOut(
        $clientId,
        $searchBy = null,
        $search = null
    ) {
        $query = FmsMiscAccount::select([
            'FMS.MISC_ACCOUNT.mbr_no',
            'CIF.CUSTOMERS.identity_no',
            'CIF.CUSTOMERS.name',
            'FMS.MISC_ACCOUNT.misc_amt',
        ])
            ->leftJoin('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.mbr_no', '=', 'FMS.MISC_ACCOUNT.mbr_no')
            ->leftJoin('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', '=', 'FMS.MEMBERSHIP.cif_id')
            ->where('FMS.MISC_ACCOUNT.client_id', $clientId)
            ->where('FMS.MEMBERSHIP.client_id', $clientId)
            ->where('CIF.CUSTOMERS.client_id', $clientId)
            ->where('FMS.MISC_ACCOUNT.misc_amt', '>', 0);

        if ($search && $searchBy) {
            $query->where($searchBy, 'like', '%' . $search . '%');
        }

        return $query->paginate(10);
    }

    public static function getMiscellaneousOutMbrData(
        $clientId = null,
        $mbrNo = null,
        $condition = true
    ) {
        $query = FmsMiscAccount::select([
            'FMS.MISC_ACCOUNT.mbr_no',
            'CIF.CUSTOMERS.identity_no',
            'CIF.CUSTOMERS.name',
            'CIF.CUSTOMERS.bank_id',
            'CIF.CUSTOMERS.bank_acct_no',
            'FMS.MISC_ACCOUNT.misc_amt',
            'FMS.ACCOUNT_MASTERS.instal_amount',
        ])
            ->leftJoin('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.mbr_no', '=', 'FMS.MISC_ACCOUNT.mbr_no')
            ->leftJoin('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', '=', 'FMS.MEMBERSHIP.cif_id')
            ->leftJoin('FMS.ACCOUNT_MASTERS', 'FMS.ACCOUNT_MASTERS.mbr_no', '=', 'FMS.MISC_ACCOUNT.mbr_no');

        if (!$condition) {
            $query->where('FMS.MISC_ACCOUNT.misc_amt', '>', 0);
        }

        $query->where('FMS.MISC_ACCOUNT.client_id', $clientId)
            ->where('CIF.CUSTOMERS.client_id', $clientId)
            ->where('FMS.ACCOUNT_MASTERS.client_id', $clientId)
            ->where('FMS.MEMBERSHIP.client_id', $clientId)
            ->where('FMS.MISC_ACCOUNT.mbr_no', $mbrNo);

        return $query->first();
    }

    //this for get financing each mbrno
    public static function getMiscellaneousOutFinancingData(
        $clientId = null,
        $mbrNo = null
    ) {
        $query = FmsAccountMaster::select([
            'FMS.ACCOUNT_MASTERS.account_no',
            'SISKOP.ACCOUNT_PRODUCTS.name as product',
            'FMS.ACCOUNT_MASTERS.instal_amount',
        ])
            ->join('FMS.ACCOUNT_POSITIONS', 'FMS.ACCOUNT_POSITIONS.account_no', '=', 'FMS.ACCOUNT_MASTERS.account_no')
            ->join('CIF.ACCOUNT_STATUSES', 'CIF.ACCOUNT_STATUSES.id', '=', 'FMS.ACCOUNT_MASTERS.account_status')
            ->join('SISKOP.ACCOUNT_PRODUCTS', 'SISKOP.ACCOUNT_PRODUCTS.id', '=', 'FMS.ACCOUNT_MASTERS.product_id')
            ->whereNotNull('FMS.ACCOUNT_POSITIONS.disbursed_amount')
            ->where('FMS.ACCOUNT_MASTERS.client_id', $clientId)
            ->where('FMS.ACCOUNT_POSITIONS.client_id', $clientId)
            ->where('CIF.ACCOUNT_STATUSES.client_id', $clientId)
            ->where('SISKOP.ACCOUNT_PRODUCTS.client_id', $clientId)
            ->where('FMS.ACCOUNT_MASTERS.account_status', 1)
            ->where('FMS.ACCOUNT_MASTERS.mbr_no', $mbrNo)
            ->orderBy('FMS.ACCOUNT_MASTERS.account_no')
            ->get();

        return $query;
    }

    public static function getAllRefundAdvance(
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
            DB::raw('products = FMS.uf_get_product(' . $clientId . ', FMS.ACCOUNT_MASTERS.product_id)'),
            'FMS.ACCOUNT_POSITIONS.disbursed_amount',
            'FMS.ACCOUNT_POSITIONS.prin_outstanding',
            'FMS.ACCOUNT_POSITIONS.uei_outstanding',
            'FMS.ACCOUNT_POSITIONS.advance_payment',
            'FMS.ACCOUNT_POSITIONS.bal_outstanding',
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

    public static function getAllDividendWithdrawalSiskop(
        $clientId = null,
        $searchBy = null,
        $search = null
    ) {
        $query = DB::table('FMS.DIVIDEND_REQ')
            ->select([
                'FMS.DIVIDEND_REQ.apply_id',
                'FMS.MEMBERSHIP.mbr_no',
                'CIF.CUSTOMERS.identity_no',
                'CIF.CUSTOMERS.name',
                'FMS.DIVIDEND_REQ.div_cash_approved',
                'FMS.DIVIDEND_FINAL.bal_dividen'
            ])
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.mbr_no', '=', 'FMS.DIVIDEND_REQ.mbr_no')
            ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', '=', 'FMS.MEMBERSHIP.cif_id')
            ->join('FMS.DIVIDEND_FINAL', 'FMS.DIVIDEND_FINAL.mbr_no', '=', 'FMS.DIVIDEND_REQ.mbr_no')
            ->where('FMS.DIVIDEND_REQ.client_id', $clientId)
            ->where('FMS.MEMBERSHIP.client_id', $clientId)
            ->where('CIF.CUSTOMERS.client_id', $clientId)
            ->where('FMS.DIVIDEND_FINAL.client_id', $clientId)
            ->whereIn('FMS.DIVIDEND_REQ.req_status', [ 4, 5, 6, 7 ])
            ->orderBy('FMS.DIVIDEND_REQ.id', 'ASC');

        if ($search && $searchBy) {
            $query->where($searchBy, 'like', '%' . $search . '%');
        }

        return $query->paginate(10);
    }

    public static function getDividendWithdrawalSiskopData(
        $clientId = null,
        $mbrNo = null
    ) {
        $query = DB::table('FMS.DIVIDEND_REQ')
            ->select([
                'FMS.DIVIDEND_REQ.apply_id',
                'FMS.MEMBERSHIP.mbr_no',
                'CIF.CUSTOMERS.identity_no',
                'CIF.CUSTOMERS.name',
                'FMS.DIVIDEND_REQ.div_cash_approved',
                'FMS.DIVIDEND_FINAL.bal_dividen'
            ])
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.mbr_no', '=', 'FMS.DIVIDEND_REQ.mbr_no')
            ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', '=', 'FMS.MEMBERSHIP.cif_id')
            ->join('FMS.DIVIDEND_FINAL', 'FMS.DIVIDEND_FINAL.mbr_no', '=', 'FMS.DIVIDEND_REQ.mbr_no')
            ->where('FMS.DIVIDEND_REQ.client_id', $clientId)
            ->where('FMS.MEMBERSHIP.client_id', $clientId)
            ->where('CIF.CUSTOMERS.client_id', $clientId)
            ->where('FMS.DIVIDEND_FINAL.client_id', $clientId)
            ->whereIn('FMS.DIVIDEND_REQ.req_status', [ 4, 5, 6, 7 ])
            ->where('FMS.DIVIDEND_REQ.mbr_no', $mbrNo);

        return $query->first();
    }

    public static function getAllDividendWithdrawal(
        $clientId = null,
        $searchBy = null,
        $search = null
    ) {
        $query = DB::table('FMS.DIVIDEND_FINAL')
                    ->select([
                        'FMS.MEMBERSHIP.mbr_no',
                        'CIF.CUSTOMERS.identity_no',
                        'CIF.CUSTOMERS.name',
                        'FMS.DIVIDEND_FINAL.bal_div_pending_withdrawal',
                        'FMS.DIVIDEND_FINAL.bal_dividen'
                    ])
                    ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.mbr_no', '=', 'FMS.DIVIDEND_FINAL.mbr_no')
                    ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', '=', 'FMS.MEMBERSHIP.cif_id')
                    ->whereRaw('ISNULL(FMS.DIVIDEND_FINAL.bal_dividen, 0) > 0')
                    ->where('FMS.DIVIDEND_FINAL.client_id', $clientId)
                    ->where('FMS.MEMBERSHIP.client_id', $clientId)
                    ->where('CIF.CUSTOMERS.client_id', $clientId);

        if ($search && $searchBy) {
            $query->where($searchBy, 'like', '%' . $search . '%');
        }

        return $query->paginate(10);
    }

    public static function getDividendWithdrawalData(
        $clientId = null,
        $mbrNo = null
    ) {
        $query = DB::table('FMS.DIVIDEND_FINAL')
                    ->select([
                        'FMS.MEMBERSHIP.mbr_no',
                        'CIF.CUSTOMERS.identity_no',
                        'CIF.CUSTOMERS.name',
                        'FMS.DIVIDEND_FINAL.bal_div_pending_withdrawal',
                        'FMS.DIVIDEND_FINAL.bal_dividen'
                    ])
                    ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.mbr_no', '=', 'FMS.DIVIDEND_FINAL.mbr_no')
                    ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', '=', 'FMS.MEMBERSHIP.cif_id')
                    ->whereRaw('ISNULL(FMS.DIVIDEND_FINAL.bal_dividen, 0) > 0')
                    ->where('FMS.DIVIDEND_FINAL.client_id', $clientId)
                    ->where('FMS.MEMBERSHIP.client_id', $clientId)
                    ->where('CIF.CUSTOMERS.client_id', $clientId)
                    ->where('FMS.DIVIDEND_FINAL.mbr_no', $mbrNo);

        return $query->first();
    }

    public static function getAllContributionWithdrawal(
        $clientId = null,
        $searchBy = null,
        $search = null
    ) {
        $query = FmsContributionReqHistory::select(
                'FMS.CONTRIBUTION_REQ_HISTORY.id',
                'FMS.CONTRIBUTION_REQ_HISTORY.apply_id',
                'FMS.CONTRIBUTION_REQ_HISTORY.mbr_no',
                'CIF.CUSTOMERS.name',
                'CIF.CUSTOMERS.bank_id',
                'CIF.CUSTOMERS.bank_acct_no',
                'CIF.CUSTOMERS.identity_no',
                'FMS.CONTRIBUTION_REQ_HISTORY.apply_amt',
                'FMS.CONTRIBUTION_REQ_HISTORY.approved_amt',
                'FMS.CONTRIBUTION_REQ_HISTORY.start_approved',
                'CIF.CUSTOMERS.email',
                'FMS.MEMBERSHIP.total_contribution')
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.mbr_no', '=', 'FMS.CONTRIBUTION_REQ_HISTORY.mbr_no')
            ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', '=', 'FMS.MEMBERSHIP.cif_id')
            ->where('FMS.CONTRIBUTION_REQ_HISTORY.client_id', $clientId)
            ->where('FMS.MEMBERSHIP.client_id', $clientId)
            ->where('CIF.CUSTOMERS.client_id', $clientId)
            ->where('FMS.MEMBERSHIP.no_of_cont_withdrawal', '<', '5')
            ->where('FMS.CONTRIBUTION_REQ_HISTORY.req_status', '1')
            ->where('FMS.MEMBERSHIP.mbr_status', 'A');

        if ($search && $searchBy) {
            $query->where($searchBy, 'like', '%' . $search . '%');
        }

        $query->orderBy('id', 'DESC');

        return $query->paginate(10);
    }

    public static function getContributionWithdrawalData(
        $clientId = null,
        $id = null
    ) {
        $query = FmsContributionReqHistory::select(
            'FMS.CONTRIBUTION_REQ_HISTORY.id',
            'FMS.CONTRIBUTION_REQ_HISTORY.apply_id',
            'FMS.CONTRIBUTION_REQ_HISTORY.mbr_no',
            'CIF.CUSTOMERS.name',
            'CIF.CUSTOMERS.bank_id',
            'CIF.CUSTOMERS.bank_acct_no',
            'CIF.CUSTOMERS.identity_no',
            'FMS.CONTRIBUTION_REQ_HISTORY.apply_amt',
            'FMS.CONTRIBUTION_REQ_HISTORY.approved_amt',
            'FMS.CONTRIBUTION_REQ_HISTORY.start_approved',
            'CIF.CUSTOMERS.email',
            'FMS.MEMBERSHIP.total_contribution')
        ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.mbr_no', '=', 'FMS.CONTRIBUTION_REQ_HISTORY.mbr_no')
        ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', '=', 'FMS.MEMBERSHIP.cif_id')
        ->where('FMS.CONTRIBUTION_REQ_HISTORY.client_id', $clientId)
        ->where('FMS.MEMBERSHIP.client_id', $clientId)
        ->where('CIF.CUSTOMERS.client_id', $clientId)
        ->where('FMS.MEMBERSHIP.no_of_cont_withdrawal', '<', '5')
        ->where('FMS.CONTRIBUTION_REQ_HISTORY.req_status', '1')
        ->where('FMS.MEMBERSHIP.mbr_status', 'A')
        ->where('FMS.CONTRIBUTION_REQ_HISTORY.id', $id);

        return $query->first();
    }
}
