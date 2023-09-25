<?php

namespace App\Livewire\Admin\Maintenance\Gender;

use Livewire\Component;
use App\Models\Ref\RefGender;

class GenderList extends Component
{
    
    public $RefGender;

    public function mount()
    {
        $this->RefGender = RefGender::all();
    }

    public function render()
    {
        return view('livewire.admin.maintenance.gender.gender-list')->extends('layouts.main');
    }
}
