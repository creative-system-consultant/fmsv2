<?php

namespace App\Livewire\Teller\WithdrawDividen;

use Livewire\Attributes\Layout;
use Livewire\Component;

class WithdrawDividen extends Component
{
    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.teller.withdraw-dividen.withdraw-dividen');
    }
}
