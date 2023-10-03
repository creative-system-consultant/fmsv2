<?php

namespace App\Livewire\Teller\Autopay;

use Livewire\Component;

class Autopay extends Component
{
    public function render()
    {
        return view('livewire.teller.autopay.autopay')->extends('layouts.main');
    }
}
