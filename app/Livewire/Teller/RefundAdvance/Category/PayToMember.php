<?php

namespace App\Livewire\Teller\RefundAdvance\Category;

use App\Services\Model\FmsAccountMaster;
use Livewire\Component;

class PayToMember extends Component
{
    public $accountNo;
    public $ic;

    public function mount($accountNo)
    {
        $this->accountNo = $accountNo;
        $accountMaster = FmsAccountMaster::getAccountData($this->accountNo);
        $this->ic = $accountMaster->fmsMembership->cifcustomer->identity_no;
    }

    public function render()
    {
        return view('livewire.teller.refund-advance.category.pay-to-member');
    }
}
