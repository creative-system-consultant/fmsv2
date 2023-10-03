<?php

namespace App\Livewire\Teller\MiscellaneousOut;

use Livewire\Component;

class MiscellaneousOutList extends Component
{
    public function render()
    {
        return view('livewire.teller.miscellaneous-out.miscellaneous-out-list')->extends('layouts.main');
    }
}
