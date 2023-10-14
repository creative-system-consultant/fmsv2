<?php

namespace App\Livewire\Teller\AccountOverlap;

use Livewire\Attributes\Layout;
use Livewire\Component;

class AccountOverlap extends Component
{
    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.teller.account-overlap.account-overlap');
    }
}
