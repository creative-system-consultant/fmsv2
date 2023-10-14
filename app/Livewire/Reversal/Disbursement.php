<?php

namespace App\Livewire\Reversal;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Disbursement extends Component
{
    public function render()
    {
        return view('livewire.reversal.disbursement')->extends('layouts.main');
    }
}
