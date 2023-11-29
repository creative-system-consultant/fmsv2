<?php

namespace App\Livewire\Reversal;

use Livewire\Attributes\Layout;
use Livewire\Component;

class ReversalList extends Component
{
    public $list_tab;
    public $tabIndex;
    public $type_financing = '';
    public $option_financing;

    public $type_general = '';
    public $option_general;

    public function checkPermission($option){
        return auth()->check() && auth()->user()->hasClientSpecificPermission($option['permission'], auth()->user()->client_id);
    }

    public function mount()
    {
        $data_tab = config('module.reversal.index');
        $this->list_tab = [];
        $found = false;
        foreach ($data_tab as $option_tab) {
            if ($this->checkPermission($option_tab)) {
                $this->list_tab[] = $option_tab;
                if (!$found) {
                    $this->tabIndex = (int) $option_tab['index'];
                    $found = true;
                }
            }
        }

        $data_financing = config('module.reversal.financing.index');
        $this->option_financing = [];
        foreach ($data_financing as $option_financing) {
            if ($this->checkPermission($option_financing)) {
                $this->option_financing[] = $option_financing;
            }
        }

        $data_general = config('module.reversal.general.index');
        $this->option_general = [];
        foreach ($data_general as $option_general) {
            if ($this->checkPermission($option_general)) {
                $this->option_general[] = $option_general;
            }
        }

    }

    public function clearFinancing()
    {
        $this->type_financing = '';
    }

    public function clearGeneral()
    {
        $this->type_general = '';
    }

    public function render()
    {
        return view('livewire.reversal.reversal-list')->extends('layouts.main');
    }
}
