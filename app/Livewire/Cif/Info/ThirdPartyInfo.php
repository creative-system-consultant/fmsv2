<?php

namespace App\Livewire\Cif\Info;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ThirdPartyInfo extends Component
{
    public function render()
    {
        return view('livewire.cif.info.third-party-info')->extends('layouts.main');
    }
}
