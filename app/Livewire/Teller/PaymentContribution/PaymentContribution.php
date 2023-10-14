<?php

namespace App\Livewire\Teller\PaymentContribution;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Lazy;
use Livewire\Component;

#[Lazy]
class PaymentContribution extends Component
{
    public $type = 'cheque';

    public function selectType($type)
    {
        $this->type = $type;
        $this->dispatch('typeUpdated', type: $this->type)->to(Details::class);
    }

    public function render()
    {
        return view('livewire.teller.payment-contribution.payment-contribution')->extends('layouts.main');
    }
}
