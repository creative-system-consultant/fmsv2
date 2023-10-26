<?php

namespace App\Livewire\Cif\Other;

use Livewire\Component;

class Index extends Component
{
    public $uuid;
    public $setIndex = 0;


    public function setState($index)
    {
        $this->setIndex = $index;
    }


    public function render()
    {
        return view('livewire.cif.other.index')->extends('layouts.main');
    }
}
