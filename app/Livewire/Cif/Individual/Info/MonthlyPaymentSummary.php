<?php

namespace App\Livewire\Cif\Individual\Info;

use Livewire\Component;

class MonthlyPaymentSummary extends Component
{
    public function render()
    {
        return view('livewire.cif.individual.info.monthly-payment-summary')->extends('layouts.main');
    }
}
