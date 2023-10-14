<?php

namespace App\Livewire\Reversal;

use Livewire\Attributes\Layout;
use Livewire\Component;

class EarlySettlement extends Component
{
    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.reversal.early-settlement');
    }
}
