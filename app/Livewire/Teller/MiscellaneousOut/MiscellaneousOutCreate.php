<?php

namespace App\Livewire\Teller\MiscellaneousOut;

use Livewire\Attributes\Layout;
use Livewire\Component;

class MiscellaneousOutCreate extends Component
{
    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.teller.miscellaneous-out.miscellaneous-out-create');
    }
}
