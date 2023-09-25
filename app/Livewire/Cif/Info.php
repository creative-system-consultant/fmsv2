<?php

namespace App\Livewire\Cif;

use Livewire\Component;

class Info extends Component
{
    public function render()
    {
        return view('livewire.cif.individual.info')->extends('layouts.main');
    }
}
