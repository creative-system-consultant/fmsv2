<?php

namespace App\Livewire\Teller\VirtualAccount;

use Livewire\Attributes\Layout;
use Livewire\Component;

class VirtualAccount extends Component
{
    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.teller.virtual-account.virtual-account');
    }
}
