<?php

namespace App\Livewire\Teller\SettlementOverlap;

use Livewire\Attributes\Layout;
use Livewire\Component;

class SettlementOverlap extends Component
{
    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.teller.settlement-overlap.settlement-overlap');
    }
}
