<?php

namespace App\Livewire\Teller\PaymentMember;

use Livewire\Attributes\Layout;
use Livewire\Component;

class PaymentMember extends Component
{
    public $setIndex = 0;


    public function setState($index)
    {
        $this->setIndex = $index;
    }

    public function render()
    {
        return view('livewire.teller.payment-member.payment-member')->extends('layouts.main');
    }
}
