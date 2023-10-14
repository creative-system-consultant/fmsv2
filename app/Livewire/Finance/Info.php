<?php

namespace App\Livewire\Finance;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Info extends Component
{

    public $setIndex = 0;


    public function setState($index)
    {
        $this->setIndex = $index;
    }

    public function render()
    {
        return view('livewire.finance.info')->extends('layouts.main');
    }
}
