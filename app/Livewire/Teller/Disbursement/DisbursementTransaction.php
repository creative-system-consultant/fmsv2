<?php

namespace App\Livewire\Teller\Disbursement;

use Livewire\Attributes\Layout;
use Livewire\Component;

class DisbursementTransaction extends Component
{
    public function render()
    {
        return view('livewire.teller.disbursement.disbursement-transaction')->extends('layouts.main');
    }
}
