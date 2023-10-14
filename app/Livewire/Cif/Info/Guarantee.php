<?php

namespace App\Livewire\Cif\Info;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Guarantee extends Component
{
    public function render()
    {
        return view('livewire.cif.info.guarantee')->extends('layouts.main');
    }
}
