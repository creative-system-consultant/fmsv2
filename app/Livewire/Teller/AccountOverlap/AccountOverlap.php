<?php

namespace App\Livewire\Teller\AccountOverlap;

use Livewire\Attributes\Layout;
use Livewire\Component;

class AccountOverlap extends Component
{
    public function render()
    {
        return view('livewire.teller.account-overlap.account-overlap')->extends('layouts.main');
    }
}
