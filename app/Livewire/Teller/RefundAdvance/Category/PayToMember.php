<?php

namespace App\Livewire\Teller\RefundAdvance\Category;

use Livewire\Component;

class PayToMember extends Component
{
    public $accountNo;

    public function mount($accountNo)
    {
        $this->accountNo = $accountNo;
    }

    public function render()
    {
        return view('livewire.teller.refund-advance.category.pay-to-member');
    }
}
