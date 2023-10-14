<?php

namespace App\Livewire\Teller\MiscellaneousOut;

use App\Services\General\ActgPeriod;
use App\Services\Model\FmsMiscAccount;
use Livewire\Attributes\Layout;
use Livewire\Component;

class MiscellaneousOutCreate extends Component
{
    public $mbrNo;
    public $startDate;
    public $endDate;

    public $name;
    public $refNo;
    public $miscAmt;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount($mbrNo)
    {
        $this->mbrNo = $mbrNo;

        $periodRange  = ActgPeriod::determinePeriodRange();
        $this->startDate = $periodRange['startDate'];
        $this->endDate = $periodRange['endDate'];

        $miscAcc = FmsMiscAccount::getFmsMiscAccountByMbrNo($this->mbrNo);
        $this->name = $miscAcc->fmsMembership->cifCustomer->name;
        $this->refNo = $miscAcc->fmsMembership->ref_no;
        $this->miscAmt = $miscAcc->misc_amt;
    }

    public function render()
    {
        return view('livewire.teller.miscellaneous-out.miscellaneous-out-create')->extends('layouts.main');
    }
}
