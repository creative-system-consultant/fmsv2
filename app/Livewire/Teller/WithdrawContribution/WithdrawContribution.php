<?php

namespace App\Livewire\Teller\WithdrawContribution;

use Livewire\Component;

class WithdrawContribution extends Component
{
    public function render()
    {
        return view('livewire.teller.withdraw-contribution.withdraw-contribution')->extends('layouts.main');
    }
}
