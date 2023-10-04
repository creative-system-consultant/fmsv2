<?php

namespace App\Livewire\Teller;

use Livewire\Component;

class TellerList extends Component
{
    public function render()
    {
        return view('livewire.teller.teller-list')->extends('layouts.main');
    }
}
