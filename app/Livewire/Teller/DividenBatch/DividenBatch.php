<?php

namespace App\Livewire\Teller\DividenBatch;

use Livewire\Attributes\Layout;
use Livewire\Component;

class DividenBatch extends Component
{
    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.teller.dividen-batch.dividen-batch');
    }
}
