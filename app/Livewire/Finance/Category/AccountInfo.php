<?php

namespace App\Livewire\Finance\Category;

use Livewire\Component;

class AccountInfo extends Component
{
    public $setIndex = 0;
    

    public function setState($index)
    {
        $this->setIndex = $index;
    }
    
    public function render()
    {
        return view('livewire.finance.category.account-info')->extends('layouts.main');
    }
}
