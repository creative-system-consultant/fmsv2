<?php

namespace App\Livewire\Finance\Category;

use App\Models\Fms\FmsAccountMaster;
use Livewire\Component;

class AccountInfo extends Component
{
    public $setIndex = 0;
    public $uuid, $customer, $account;


    public function setState($index)
    {
        $this->setIndex = $index;
    }

    public function mount()
    {
        $this->account = FmsAccountMaster::where('uuid', '=', $this->uuid)->first();

        $this->customer =  $this->account->membership->customer->name;
    }

    public function render()
    {
        return view('livewire.finance.category.account-info')->extends('layouts.main');
    }
}
