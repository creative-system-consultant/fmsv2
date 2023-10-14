<?php

namespace App\Livewire\Teller\MiscellaneousOut\Category;

use App\Services\Model\FmsMiscAccount;
use Livewire\Component;

class Members extends Component
{
    public $mbrNo;
    public $startDate;
    public $endDate;
    public $miscAmt;
    public $ic;

    public function mount()
    {
        $miscAcc = FmsMiscAccount::getFmsMiscAccountByMbrNo($this->mbrNo);
        $this->ic = $miscAcc->fmsMembership->cifCustomer->identity_no;
    }

    public function render()
    {
        return view('livewire.teller.miscellaneous-out.category.members');
    }
}
