<?php

namespace App\Livewire\Teller\DividenBatch;

use Livewire\Component;

class DividenBatch extends Component
{
    public function render()
    {
        return view('livewire.teller.dividen-batch.dividen-batch')->extends('layouts.main');
    }
}
