<?php

namespace App\Livewire\Teller\RefundAdvance;

use App\Services\Model\FmsAccountMaster;
use Livewire\Attributes\Layout;
use Livewire\Component;

class RefundAdvanceCreate extends Component
{
    public $name;
    public $accountNo;
    public $advAmount;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function redirectBack()
    {
        $this->accountNo = NULL;
        $this->dispatch('clearSelectedAcc')->to(RefundAdvanceList::class);
    }

    public function mount($account_no)
    {
        $this->accountNo = $account_no;

        $accountMaster = FmsAccountMaster::getAccountData($this->accountNo);
        $this->name = $accountMaster->fmsMembership->cifcustomer->name;
        $this->accountNo = $accountMaster->account_no;
        $this->advAmount = $accountMaster->fmsAccountPosition->advance_payment;
    }

    public function render()
    {
        return view('livewire.teller.refund-advance.refund-advance-create')->extends('layouts.main');
    }
}
