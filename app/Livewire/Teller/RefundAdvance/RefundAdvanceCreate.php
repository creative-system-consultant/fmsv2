<?php

namespace App\Livewire\Teller\RefundAdvance;

use App\Services\Model\FmsAccountMaster;
use Livewire\Component;

class RefundAdvanceCreate extends Component
{
    public $name;
    public $accountNo;
    public $advAmount;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount($account_no)
    {
        $this->accountNo = $account_no;
    }

    public function render()
    {
        $accountMaster = FmsAccountMaster::getAccountData($this->accountNo);;
        $this->name = $accountMaster->cifcustomer->name;
        $this->accountNo = $accountMaster->account_no;
        $this->advAmount = $accountMaster->fmsAccountPosition->advance_payment;

        return view('livewire.teller.refund-advance.refund-advance-create')->extends('layouts.main');
    }
}
