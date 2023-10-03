<?php

namespace App\Livewire\Cif\Info;

use Livewire\Component;

class Details extends Component
{
    public $editDetail = false;

    function editDetail(){
        $this->editDetail = true;
    }

    public function render()
    {

        return view('livewire.cif.info.details')->extends('layouts.main');
    }
}
