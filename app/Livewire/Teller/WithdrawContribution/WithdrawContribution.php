<?php

namespace App\Livewire\Teller\WithdrawContribution;

use Livewire\Attributes\Layout;
use Livewire\Component;

class WithdrawContribution extends Component
{
    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.teller.withdraw-contribution.withdraw-contribution');
    }
}
