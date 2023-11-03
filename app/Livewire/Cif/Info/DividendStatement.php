<?php

namespace App\Livewire\Cif\Info;

use App\Models\Cif\CifCustomer;
use App\Models\Fms\FmsDividendStatement;
use DB;
use Livewire\Component;

class DividendStatement extends Component
{
    public $customer, $uuid;
    public $startDateDividen, $endDateDividen;

    public function mount()
    {
        $this->startDateDividen    =  '2021-12-31';
        $this->endDateDividen       =  now()->format('Y-m-d');
        $this->customer = CifCustomer::where('uuid', $this->uuid)->first();
    }

    public function render()
    {

        $bal_div = DB::table('fms.dividend_final')
            ->select('bal_dividen', DB::raw('bal_div_withdrawal = isnull(bal_div_withdrawal,0.00)'))
            ->where('mbr_no', $this->customer->membership->mbr_no)
            ->first();

        $dividendstmt = FmsDividendStatement::with('TxnCode')
            ->where('mbr_no', $this->customer->membership->mbr_no)
            ->whereBetween(DB::raw('cast(txn_date as date)'), [$this->startDateDividen, $this->endDateDividen])
            ->orderby('id', 'asc')
            ->get();

        return view('livewire.cif.info.dividend-statement', [
            'dividendstmt' => $dividendstmt,
            'bal_div' =>  $bal_div
        ])->extends('layouts.main');
    }
}
