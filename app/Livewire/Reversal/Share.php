<?php

namespace App\Livewire\Reversal;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Share extends Component
{
    public function render()
    {
        return view('livewire.reversal.share')->extends('layouts.main');
    }
}
