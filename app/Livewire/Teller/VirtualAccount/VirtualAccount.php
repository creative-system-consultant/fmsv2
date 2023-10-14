<?php

namespace App\Livewire\Teller\VirtualAccount;

use Livewire\Attributes\Layout;
use Livewire\Component;

class VirtualAccount extends Component
{
    public function render()
    {
        return view('livewire.teller.virtual-account.virtual-account')->extends('layouts.main');
    }
}
