<?php

namespace App\Livewire\Teller\FinancingRepayment;

use Livewire\Component;

class FinancingRepayment extends Component
{
    public  $type = 'cheque';

    public function selectType($type){
        $this->type = $type;
    }

    public function render()
    {
        return view('livewire.teller.financing-repayment.financing-repayment')->extends('layouts.main');
    }
}
