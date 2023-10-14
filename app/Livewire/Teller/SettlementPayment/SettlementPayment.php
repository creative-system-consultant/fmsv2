<?php

namespace App\Livewire\Teller\SettlementPayment;

use Livewire\Attributes\Layout;
use Livewire\Component;

class SettlementPayment extends Component
{

    public  $type = 'cheque';

    public function selectType($type){
        $this->type = $type;
    }

    public function render()
    {
        return view('livewire.teller.settlement-payment.settlement-payment')->extends('layouts.main');
    }
}
