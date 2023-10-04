<?php

namespace App\Livewire\Dividen;

use Livewire\Component;

class DividenIndex extends Component
{
    public $setIndex = 0;
    

    public function setState($index)
    {
        $this->setIndex = $index;
    }
    
    public function render()
    {
        return view('livewire.dividen.dividen-index')->extends('layouts.main');
    }
}
