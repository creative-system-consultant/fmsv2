<?php

namespace App\Livewire\Cif\Info;

use Livewire\Attributes\Layout;
use Livewire\Component;

class OthersPayment extends Component
{
    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.cif.info.others-payment');
    }
}
