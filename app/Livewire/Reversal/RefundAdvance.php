<?php

namespace App\Livewire\Reversal;

use Livewire\Component;

class RefundAdvance extends Component
{
    public function render()
    {
        return view('livewire.reversal.refund-advance')->extends('layouts.main');
    }
}
