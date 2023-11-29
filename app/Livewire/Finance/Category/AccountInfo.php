<?php

namespace App\Livewire\Finance\Category;

use App\Models\Fms\FmsAccountMaster;
use Livewire\Component;

class AccountInfo extends Component
{
    public $setIndex;
    public $uuid, $customer, $account;


    public function setState($index)
    {
        $this->setIndex = $index;
    }

    public function mount()
    {
        $this->account = FmsAccountMaster::where('uuid', '=', $this->uuid)->first();

        $this->customer =  $this->account->membership->customer->name;

        // Default to the first permitted tab
        foreach (config('module.financing-info.account-info.index') as $config) {
            $hasPermission = auth()->check() && auth()->user()->hasClientSpecificPermission($config['permission'], auth()->user()->client_id);
            if ($hasPermission) {
                $this->setIndex = (int) $config['index'];
                break;
            }
        }
    }

    public function render()
    {
        return view('livewire.finance.category.account-info')->extends('layouts.main');
    }
}
