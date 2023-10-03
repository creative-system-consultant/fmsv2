<?php

namespace App\Livewire\Teller\GlTransaction;

use Livewire\Component;

class GlTransaction extends Component
{
    public function render()
    {
        return view('livewire.teller.gl-transaction.gl-transaction')->extends('layouts.main');
    }
}
