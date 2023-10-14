<?php

namespace App\Livewire\Teller\CloseMembership;

use Livewire\Attributes\Layout;
use Livewire\Component;

class CloseMembership extends Component
{
    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.teller.close-membership.close-membership');
    }
}
