<?php

namespace App\Livewire\Reversal;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Miscellaneous extends Component
{
    public function render()
    {
        return view('livewire.reversal.miscellaneous')->extends('layouts.main');
    }
}
