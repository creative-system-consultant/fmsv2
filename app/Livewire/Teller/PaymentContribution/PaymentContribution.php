<?php

namespace App\Livewire\Teller\PaymentContribution;

use Livewire\Attributes\Layout;
use Livewire\Component;

class PaymentContribution extends Component
{
    public $type = 'cheque';

    public function selectType($type)
    {
        $this->type = $type;
        $this->dispatch('typeUpdated', type: $this->type)->to(Details::class);
    }

    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.teller.payment-contribution.payment-contribution');
    }
}
