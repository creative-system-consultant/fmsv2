<?php

namespace App\Livewire\Finance;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Info extends Component
{
    public $setIndex;

    public function mount()
    {
        // Default to the first permitted tab
        foreach (config('module.financing-info.index') as $config) {
            $hasPermission = auth()->check() && auth()->user()->hasClientSpecificPermission($config['permission'], auth()->user()->client_id);
            if ($hasPermission) {
                $this->setIndex = (int) $config['index'];
                break;
            }
        }
    }

    public function setState($index)
    {
        $this->setIndex = $index;
    }

    public function render()
    {
        return view('livewire.finance.info')->extends('layouts.main');
    }
}
