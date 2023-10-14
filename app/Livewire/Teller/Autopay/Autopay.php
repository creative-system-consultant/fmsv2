<?php

namespace App\Livewire\Teller\Autopay;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Autopay extends Component
{
    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.teller.autopay.autopay');
    }
}
