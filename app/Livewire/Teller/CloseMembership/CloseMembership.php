<?php

namespace App\Livewire\Teller\CloseMembership;

use Livewire\Attributes\Layout;
use Livewire\Component;

class CloseMembership extends Component
{
    public function render()
    {
        return view('livewire.teller.close-membership.close-membership')->extends('layouts.main');
    }
}
