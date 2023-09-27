<?php

namespace App\Livewire\Cif\Info;

use Livewire\Component;

class Beneficiary extends Component
{
    public function render()
    {
        return view('livewire.cif.info.beneficiary')->extends('layouts.main');
    }
}
