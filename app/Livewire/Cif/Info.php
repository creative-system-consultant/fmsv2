<?php

namespace App\Livewire\Cif;

use Livewire\Component;

class Info extends Component
{
    public $uuid;
    public $setIndex = 0;
    

    public function setState($index)
    {
        $this->setIndex = $index;
    }

    public function render()
    {
        return view('livewire.cif.info')->extends('layouts.main');
    }
}
