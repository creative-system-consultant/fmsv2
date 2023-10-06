<?php

namespace App\Services\Module;

use App\Models\Cif\CifCustomer;
use App\Models\Systm\SysActgPeriod;
use Carbon\Carbon;
use DB;

class RefundAdvance
{
    const CLOSE_FLAG = 'N';

    public function __construct()
    {
        //
    }

    private static function getAdvanceQuery()
    {
        return CifCustomer::select(
                'cif.customers.uuid',
                'cif.customers.icno',
                'cif.customers.ref_no',
                'cif.customers.name',
                'FMS.ACCOUNT_MASTERS.account_no',
                DB::raw('products = FMS.uf_get_product(FMS.ACCOUNT_MASTERS.product_id)'),
                'FMS.ACCOUNT_POSITIONS.disbursed_amount',
                'FMS.ACCOUNT_POSITIONS.prin_outstanding',
                'FMS.ACCOUNT_POSITIONS.uei_outstanding',
                'FMS.ACCOUNT_POSITIONS.advance_payment',
                'FMS.ACCOUNT_POSITIONS.bal_outstanding'
            )
            ->join('FMS.ACCOUNT_MASTERS', 'cif.customers.ref_no', 'FMS.ACCOUNT_MASTERS.mbr_no')
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

    public static function determinePeriodRange()
    {
        $actg_period_prevMonth = SysActgPeriod::select('actg_period_start', 'actg_period_end')
                                                ->where('actg_period_start', '=', Carbon::now()->subMonth(1)->startOfMonth())
                                                ->where('actg_close_flag', '=', self::CLOSE_FLAG)
                                                ->first();

        $actg_period_thisMonth = SysActgPeriod::select('actg_period_start', 'actg_period_end')
                                                ->where('actg_period_start', '=', Carbon::now()->startOfMonth())
                                                ->where('actg_close_flag', '=', self::CLOSE_FLAG)
                                                ->first();

        /* set start date & end date */
        if ($actg_period_prevMonth != NULL && $actg_period_thisMonth != NULL) {
            return ['startDate' => $actg_period_prevMonth->actg_period_start, 'endDate' => $actg_period_thisMonth->actg_period_end];
        } elseif (!$actg_period_prevMonth && $actg_period_thisMonth) {
            return ['startDate' => $actg_period_thisMonth->actg_period_start, 'endDate' => $actg_period_thisMonth->actg_period_end];
        } elseif ($actg_period_prevMonth && !$actg_period_thisMonth) {
            return ['startDate' => $actg_period_prevMonth->actg_period_start, 'endDate' => $actg_period_prevMonth->actg_period_end];
        } else {
            return ['startDate' => NULL, 'endDate' => NULL];
        }
    }
}