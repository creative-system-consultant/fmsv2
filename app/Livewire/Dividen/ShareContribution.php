<?php

namespace App\Livewire\Dividen;

use App\Models\Fms\DividenDeclareDate;
use App\Models\Fms\DividenShareBonusDate;
use Carbon\Carbon;
use DB;
use Livewire\Component;

class ShareContribution extends Component
{
    public $div_share, $div_contribution;
    public $profit, $profit_cont, $actg_period_prevMonth, $actg_period_thisMonth;
    public $date_declare,  $date_sb_declare, $year, $div_calc;

    public function mount()
    {
        $this->div_share = DB::table('FMS.DIVIDEND_SHARE')
            ->select(DB::raw("count(*) as bil_share, SUM(FMS.DIVIDEND_SHARE.total_kelayakan) as total_share"))
            ->where(function ($query) {
                $query->where('FMS.DIVIDEND_SHARE.jan_kelayakan', 'Y')
                    ->orWhere('FMS.DIVIDEND_SHARE.feb_kelayakan', 'Y')
                    ->orWhere('FMS.DIVIDEND_SHARE.mar_kelayakan', 'Y')
                    ->orWhere('FMS.DIVIDEND_SHARE.apr_kelayakan', 'Y')
                    ->orWhere('FMS.DIVIDEND_SHARE.may_kelayakan', 'Y')
                    ->orWhere('FMS.DIVIDEND_SHARE.jun_kelayakan', 'Y')
                    ->orWhere('FMS.DIVIDEND_SHARE.jul_kelayakan', 'Y')
                    ->orWhere('FMS.DIVIDEND_SHARE.aug_kelayakan', 'Y')
                    ->orWhere('FMS.DIVIDEND_SHARE.sep_kelayakan', 'Y')
                    ->orWhere('FMS.DIVIDEND_SHARE.oct_kelayakan', 'Y')
                    ->orWhere('FMS.DIVIDEND_SHARE.nov_kelayakan', 'Y')
                    ->orWhere('FMS.DIVIDEND_SHARE.dec_kelayakan', 'Y');
            })
            ->where('unique_id', 56)
            ->first();

        $this->div_contribution = DB::table('fms.dividend_contribution')
            ->select(DB::raw("count(*) as bil_con,SUM(fms.dividend_contribution.total_kelayakan) as total_con"))
            ->where(function ($query) {
                $query->where('fms.dividend_contribution.jan_kelayakan', 'Y')
                    ->orWhere('fms.dividend_contribution.feb_kelayakan', 'Y')
                    ->orWhere('fms.dividend_contribution.mar_kelayakan', 'Y')
                    ->orWhere('fms.dividend_contribution.apr_kelayakan', 'Y')
                    ->orWhere('fms.dividend_contribution.may_kelayakan', 'Y')
                    ->orWhere('fms.dividend_contribution.jun_kelayakan', 'Y')
                    ->orWhere('fms.dividend_contribution.jul_kelayakan', 'Y')
                    ->orWhere('fms.dividend_contribution.aug_kelayakan', 'Y')
                    ->orWhere('fms.dividend_contribution.sep_kelayakan', 'Y')
                    ->orWhere('fms.dividend_contribution.oct_kelayakan', 'Y')
                    ->orWhere('fms.dividend_contribution.nov_kelayakan', 'Y')
                    ->orWhere('fms.dividend_contribution.dec_kelayakan', 'Y');
            })
            ->where('unique_id', 56)
            ->first();

        $this->actg_period_prevMonth = DB::table('SYSTM.SYS_ACTG_PERIOD')
            ->select('actg_period_start', 'actg_period_end')
            ->where('actg_period_start', '=', Carbon::now()->subMonth(1)->startOfMonth())
            ->where('actg_close_flag', '=', 'N')
            ->first();

        $this->actg_period_thisMonth = DB::table('SYSTM.SYS_ACTG_PERIOD')
            ->select('actg_period_start', 'actg_period_end')
            ->where('actg_period_start', '=', Carbon::now()->startOfMonth())
            ->where('actg_close_flag', '=', 'N')
            ->first();

        /* set start date & end date */
        if ($this->actg_period_prevMonth != NULL && $this->actg_period_thisMonth != NULL) // if prev month NOT CLOSE & this month NOT CLOSE
        {
            $start = $this->actg_period_prevMonth->actg_period_start;
            $end = $this->actg_period_thisMonth->actg_period_end;
        } else if ($this->actg_period_prevMonth == NULL && $this->actg_period_thisMonth != NULL) // if prev month IS CLOSE & this month NOT CLOSE
        {
            $start = $this->actg_period_thisMonth->actg_period_start;
            $end = $this->actg_period_thisMonth->actg_period_end;
        } else if ($this->actg_period_prevMonth != NULL && $this->actg_period_thisMonth == NULL) // if prev month NOT CLOSE & this month IS CLOSE
        {
            $start = $this->actg_period_prevMonth->actg_period_start;
            $end = $this->actg_period_prevMonth->actg_period_end;
        } else {
            $start = NULL;
            $end = NULL;
        }

        //date div declare
        $this->date_declare = DividenDeclareDate::where('years', $this->year)->first();
        $this->date_sb_declare = DividenShareBonusDate::where('years', $this->year)->first();
        $this->div_calc = DB::select('EXEC FMS.up_calc_total_div ?, ?', [1, 56]);
        // dd($this->div_calc);
    }
    public function render()
    {
        return view('livewire.dividen.share-contribution');
    }
}
