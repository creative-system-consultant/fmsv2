<?php

namespace App\Livewire\Teller\WithdrawDividen;

use Livewire\Attributes\Layout;
use Livewire\Component;

class WithdrawDividen extends Component
{
    public function render()
    {
        return view('livewire.teller.withdraw-dividen.withdraw-dividen')->extends('layouts.main');
    }
}
