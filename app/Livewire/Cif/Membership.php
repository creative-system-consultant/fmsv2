<?php

namespace App\Livewire\Cif;

use App\Models\Cif\CifCustomer;
use Livewire\Component;

class Membership extends Component
{
    public $uuid, $name, $cID;
    public $setIndex = 0;

    public function mount()
    {
        $customerName = CifCustomer::select('name', 'id')->where('uuid', $this->uuid)->first();
        $this->name = $customerName->name;
        $this->cID = $customerName->id;
    }

    public function render()
    {
        return view('livewire.cif.membership')->extends('layouts.main');
    }
}
