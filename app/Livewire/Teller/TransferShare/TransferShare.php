<?php

namespace App\Livewire\Teller\TransferShare;

use Livewire\Component;

class TransferShare extends Component
{
    public function render()
    {
        return view('livewire.teller.transfer-share.transfer-share')->extends('layouts.main');
    }
}
