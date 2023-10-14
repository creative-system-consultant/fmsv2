<?php

namespace App\Livewire\Teller\MiscellaneousIn;

use Livewire\Attributes\Layout;
use Livewire\Component;

class MiscellaneousIn extends Component
{
    public  $type = 'cheque';

    public function selectType($type){
        $this->type = $type;
    }

    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.teller.miscellaneous-in.miscellaneous-in');
    }
}
