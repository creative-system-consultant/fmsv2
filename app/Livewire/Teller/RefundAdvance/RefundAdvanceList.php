<?php

namespace App\Livewire\Teller\RefundAdvance;

use Livewire\Component;

class RefundAdvanceList extends Component
{
    public function render()
    {
        return view('livewire.teller.refund-advance.refund-advance-list')->extends('layouts.main');
    }
}
