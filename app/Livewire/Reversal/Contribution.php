<?php

namespace App\Livewire\Reversal;

use Livewire\Component;

class Contribution extends Component
{
    public function render()
    {
        return view('livewire.reversal.contribution')->extends('layouts.main');
    }
}
