<?php

namespace App\Livewire\Teller\ThirdParty;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ThirdParty extends Component
{
    public $paymentMode = [
        'CHEQUE',
        'CASH/CDM',
        'IBT',
        'CONTRIBUTION',
        'MISC',
    ];

    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.teller.third-party.third-party');
    }
}
