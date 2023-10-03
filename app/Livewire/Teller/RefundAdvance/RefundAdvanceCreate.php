<?php

namespace App\Livewire\Teller\RefundAdvance;

use Livewire\Component;

class RefundAdvanceCreate extends Component
{
    public function render()
    {
        return view('livewire.teller.refund-advance.refund-advance-create')->extends('layouts.main');
    }
}
