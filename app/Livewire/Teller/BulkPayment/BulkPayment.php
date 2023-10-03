<?php

namespace App\Livewire\Teller\BulkPayment;

use Livewire\Component;

class BulkPayment extends Component
{
    public  $type = 'cheque';

    public function selectType($type){
        $this->type = $type;
    }

    public function render()
    {
        return view('livewire.teller.bulk-payment.bulk-payment')->extends('layouts.main');
    }
}
