<?php

namespace App\Livewire\Cif\Info;

use Livewire\Component;

class Address extends Component
{
    public function render()
    {
        return view('livewire.cif.info.address')->extends('layouts.main');
    }
}
