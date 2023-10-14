<?php

namespace App\Livewire\Cif\Info;

use Livewire\Attributes\Layout;
use Livewire\Component;

class DividendStatement extends Component
{
    public function render()
    {
        return view('livewire.cif.info.dividend-statement')->extends('layouts.main');
    }
}
