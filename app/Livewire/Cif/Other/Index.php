<?php

namespace App\Livewire\Cif\Other;

use App\Models\Cif\CifCustomer;
use Livewire\Component;

class Index extends Component
{
    public $uuid;
    public $setIndex = 0;


    public function setState($index)
    {
        $this->setIndex = $index;
    }

    public function mount()
    {
        $CustomerInfo = CifCustomer::where('uuid', $this->uuid)->first();
        $this->uuid = $CustomerInfo->uuid;
    }


    public function render()
    {
        return view('livewire.cif.other.index')->extends('layouts.main');
    }
}
