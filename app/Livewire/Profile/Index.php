<?php

namespace App\Livewire\Profile;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.profile.index');
    }
}
