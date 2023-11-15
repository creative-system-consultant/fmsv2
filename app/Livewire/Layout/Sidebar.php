<?php

namespace App\Livewire\Layout;

use Livewire\Component;

class Sidebar extends Component
{
    protected $listeners = ['clientUpdated' => '$refresh'];

    public function render()
    {
        return view('livewire.layout.sidebar');
    }
}
