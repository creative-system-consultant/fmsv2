<?php

namespace App\Livewire\Teller\PurchaseShare;

use Livewire\Attributes\Layout;
use Livewire\Component;

class PurchaseShare extends Component
{
    public  $type = 'cheque';

    public function selectType($type){
        $this->type = $type;
    }

    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.teller.purchase-share.purchase-share');
    }
}
