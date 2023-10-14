<?php

namespace App\Livewire\Profile;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.profile.index')->extends('layouts.main');
    }
}
