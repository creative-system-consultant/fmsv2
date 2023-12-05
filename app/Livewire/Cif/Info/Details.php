<?php

namespace App\Livewire\Cif\Info;

use App\Models\Cif\CifCustomer;
use App\Models\Fms\Membership;
use Livewire\Component;

class Details extends Component
{
    public $uuid;

    public function render()
    {
        return view('livewire.cif.info.details')->extends('layouts.main');
    }
}
