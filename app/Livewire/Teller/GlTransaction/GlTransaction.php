<?php

namespace App\Livewire\Teller\GlTransaction;

use Livewire\Attributes\Layout;
use Livewire\Component;

class GlTransaction extends Component
{
    #[Layout('layouts.main')]

    public function render()
    {
        return view('livewire.teller.gl-transaction.gl-transaction');
    }
}
