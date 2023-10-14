<?php

namespace App\Livewire\Reversal;

use Livewire\Attributes\Layout;
use Livewire\Component;

class RefundAdvance extends Component
{
    public function render()
    {
        return view('livewire.reversal.refund-advance')->extends('layouts.main');
    }
}
