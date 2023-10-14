<?php

namespace App\Livewire\Teller\BulkPayment;

use Livewire\Attributes\Layout;
use Livewire\Component;

class BulkPayment extends Component
{
    public  $type = 'cheque';

    public function selectType($type){
        $this->type = $type;
    }

    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.teller.bulk-payment.bulk-payment');
    }
}
