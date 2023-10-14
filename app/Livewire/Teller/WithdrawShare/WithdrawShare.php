<?php

namespace App\Livewire\Teller\WithdrawShare;

use Livewire\Attributes\Layout;
use Livewire\Component;

class WithdrawShare extends Component
{
    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.teller.withdraw-share.withdraw-share');
    }
}
