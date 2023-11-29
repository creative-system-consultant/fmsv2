<?php

namespace App\Livewire\Cif\Other;

use App\Models\Cif\CifCustomer;
use Livewire\Component;

class Index extends Component
{
    public $uuid;
    public $setIndex = 0;


    public function setState($index)
    {
        $this->setIndex = $index;
    }

    public function mount()
    {
        $CustomerInfo = CifCustomer::where('uuid', $this->uuid)->first();
        $this->uuid = $CustomerInfo->uuid;

        // Default to the first permitted tab
        foreach (config('module.other-info.tab.index') as $config) {
            $hasPermission = auth()->check() && auth()->user()->hasClientSpecificPermission($config['permission'], auth()->user()->client_id);
            if ($hasPermission) {
                $this->setIndex = (int) $config['index'];
                break;
            }
        }
    }


    public function render()
    {
        return view('livewire.cif.other.index')->extends('layouts.main');
    }
}
