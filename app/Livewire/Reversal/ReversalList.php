<?php

namespace App\Livewire\Reversal;

use Livewire\Component;

class ReversalList extends Component
{
    public function render()
    {
        return view('livewire.reversal.reversal-list')->extends('layouts.main');
    }
}
