<?php

namespace App\Livewire\Teller\MiscellaneousOut;

use Livewire\Attributes\Layout;
use Livewire\Component;

class MiscellaneousOutCreate extends Component
{
    public function render()
    {
        return view('livewire.teller.miscellaneous-out.miscellaneous-out-create')->extends('layouts.main');
    }
}
