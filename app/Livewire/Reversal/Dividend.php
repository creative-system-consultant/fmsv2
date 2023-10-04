<?php

namespace App\Livewire\Reversal;

use Livewire\Component;

class Dividend extends Component
{
    public function render()
    {
        return view('livewire.reversal.dividend')->extends('layouts.main');
    }
}
