<?php

namespace App\Livewire\Teller\DividenApproval;

use Livewire\Attributes\Layout;
use Livewire\Component;

class DividenApproval extends Component
{
    public function render()
    {
        return view('livewire.teller.dividen-approval.dividen-approval')->extends('layouts.main');
    }
}
