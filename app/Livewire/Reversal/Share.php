<?php

namespace App\Livewire\Reversal;

use Livewire\Component;

class Share extends Component
{
    public function render()
    {
        return view('livewire.reversal.share')->extends('layouts.main');
    }
}
