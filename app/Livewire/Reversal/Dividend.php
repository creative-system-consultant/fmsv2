<?php

namespace App\Livewire\Reversal;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Dividend extends Component
{
    public function render()
    {
        return view('livewire.reversal.dividend')->extends('layouts.main');
    }
}
