<?php

namespace App\Livewire\Reversal;

use Livewire\Component;

class OtherPayment extends Component
{
    public function render()
    {
        return view('livewire.reversal.other-payment')->extends('layouts.main');
    }
}
