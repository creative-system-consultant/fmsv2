<?php

namespace App\Livewire\Calulator;

use Livewire\Attributes\Layout;
use Livewire\Component;

class CalculatorIndex extends Component
{
    public function render()
    {
        return view('livewire.calulator.calculator-index')->extends('layouts.main');
    }
}
