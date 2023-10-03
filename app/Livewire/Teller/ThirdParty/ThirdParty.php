<?php

namespace App\Livewire\Teller\ThirdParty;

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
    
    public function render()
    {
        return view('livewire.teller.third-party.third-party')->extends('layouts.main');
    }
}
