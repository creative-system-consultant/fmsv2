<?php

namespace App\Livewire\Cif\Individual\Info;

use Livewire\Component;

class DividendStatement extends Component
{
    public function render()
    {
        return view('livewire.cif.individual.info.dividend-statement')->extends('layouts.main');
    }
}


