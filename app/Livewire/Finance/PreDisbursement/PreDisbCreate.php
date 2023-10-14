<?php

namespace App\Livewire\Finance\PreDisbursement;

use Livewire\Attributes\Layout;
use Livewire\Component;

class PreDisbCreate extends Component
{
    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.finance.pre-disbursement.pre-disb-create');
    }
}
