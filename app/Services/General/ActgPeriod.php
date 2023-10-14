<?php

namespace App\Services\General;

use App\Models\Systm\SysActgPeriod;
use Carbon\Carbon;

/**
 * This service class provides functionalities related to accounting periods.
 */
class ActgPeriod
{
    // Constant representing the flag for a non-closed accounting period.
    const CLOSE_FLAG = 'N';

    /**
     * Determine the range (start and end dates) of the current and previous accounting periods
     * based on the current month and the closed status of these periods.
     *
     * @return array Array containing start and end dates for the period.
     */
    public static function determinePeriodRange()
    {
        // Fetch the accounting period data for the previous month which is not closed.
        $actg_period_prevMonth = SysActgPeriod::select('actg_period_start', 'actg_period_end')
            ->where('actg_period_start', '=', Carbon::now()->subMonth(1)->startOfMonth())
            ->where('actg_close_flag', '=', self::CLOSE_FLAG)
            ->first();

        // Fetch the accounting period data for the current month which is not closed.
        $actg_period_thisMonth = SysActgPeriod::select('actg_period_start', 'actg_period_end')
            ->where('actg_period_start', '=', Carbon::now()->startOfMonth())
            ->where('actg_close_flag', '=', self::CLOSE_FLAG)
            ->first();

        // Check if accounting period data is available for both the previous and the current month.
        if ($actg_period_prevMonth != NULL && $actg_period_thisMonth != NULL) {
            // If data is available for both months, set the start date from the previous month and the end date from the current month.
            return ['startDate' => $actg_period_prevMonth->actg_period_start, 'endDate' => $actg_period_thisMonth->actg_period_end];
        }
        // Check if accounting period data is available only for the current month and not for the previous month.
        elseif (!$actg_period_prevMonth && $actg_period_thisMonth) {
            // If only the current month has data, set both the start and end dates from the current month's data.
            return ['startDate' => $actg_period_thisMonth->actg_period_start, 'endDate' => $actg_period_thisMonth->actg_period_end];
        }
        // Check if accounting period data is available only for the previous month and not for the current month.
        elseif ($actg_period_prevMonth && !$actg_period_thisMonth) {
            // If only the previous month has data, set both the start and end dates from the previous month's data.
            return ['startDate' => $actg_period_prevMonth->actg_period_start, 'endDate' => $actg_period_prevMonth->actg_period_end];
        } else {
            // If no accounting period data is available for both months, return NULL for both start and end dates.
            return ['startDate' => NULL, 'endDate' => NULL];
        }
    }
}
