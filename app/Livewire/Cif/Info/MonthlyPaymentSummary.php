<?php

namespace App\Livewire\Cif\Info;

use Livewire\Attributes\Layout;
use Livewire\Component;

class MonthlyPaymentSummary extends Component
{
    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.cif.info.monthly-payment-summary');
    }
}
