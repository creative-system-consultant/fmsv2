<?php

namespace App\Livewire\Calulator;

use Livewire\Attributes\Layout;
use Livewire\Component;

class CalculatorIndex extends Component
{
    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.calulator.calculator-index');
    }
}
