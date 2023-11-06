<?php

namespace App\Livewire\Dividen;

use DB;
use Livewire\Component;

class ShareBonus extends Component
{
    public $div_share_bonus, $profit_share_bonus;

    public function mount()
    {

        $this->div_share_bonus = DB::table('FMS.DIVIDEND_SHARE_BONUS')
            ->select(DB::raw("count(*) as bil_share_bonus, SUM(FMS.DIVIDEND_SHARE_BONUS.total_kelayakan) as total_share_bonus"))
            ->where(function ($query) {
                $query->where('FMS.DIVIDEND_SHARE_BONUS.jan_kelayakan', 'Y')
                    ->orWhere('FMS.DIVIDEND_SHARE_BONUS.feb_kelayakan', 'Y')
                    ->orWhere('FMS.DIVIDEND_SHARE_BONUS.mar_kelayakan', 'Y')
                    ->orWhere('FMS.DIVIDEND_SHARE_BONUS.apr_kelayakan', 'Y')
                    ->orWhere('FMS.DIVIDEND_SHARE_BONUS.may_kelayakan', 'Y')
                    ->orWhere('FMS.DIVIDEND_SHARE_BONUS.jun_kelayakan', 'Y')
                    ->orWhere('FMS.DIVIDEND_SHARE_BONUS.jul_kelayakan', 'Y')
                    ->orWhere('FMS.DIVIDEND_SHARE_BONUS.aug_kelayakan', 'Y')
                    ->orWhere('FMS.DIVIDEND_SHARE_BONUS.sep_kelayakan', 'Y')
                    ->orWhere('FMS.DIVIDEND_SHARE_BONUS.oct_kelayakan', 'Y')
                    ->orWhere('FMS.DIVIDEND_SHARE_BONUS.nov_kelayakan', 'Y')
                    ->orWhere('FMS.DIVIDEND_SHARE_BONUS.dec_kelayakan', 'Y');
            })
            ->where('unique_id', 56)
            ->first();
    }

    public function render()
    {
        return view('livewire.dividen.share-bonus');
    }
}
