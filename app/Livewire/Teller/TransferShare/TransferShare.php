<?php

namespace App\Livewire\Teller\TransferShare;

use Livewire\Attributes\Layout;
use Livewire\Component;

class TransferShare extends Component
{
    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.teller.transfer-share.transfer-share');
    }
}
