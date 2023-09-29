<?php

namespace App\Livewire\Cif;

use Livewire\Component;

class Individual extends Component
{
    public function render()
    {
        return view('livewire.cif.individual')->extends('layouts.main');
    }
}
