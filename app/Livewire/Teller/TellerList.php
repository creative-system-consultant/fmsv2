<?php

namespace App\Livewire\Teller;

use Livewire\Component;

class TellerList extends Component
{
    public $list_tab;
    public $tabIndex;
    public $type_payment_in = '';
    public $option_payment_in;

    public $type_payment_out = '';
    public $option_payment_out;

    public function checkPermission($option)
    {
        return auth()->check() && auth()->user()->hasClientSpecificPermission($option['permission'], auth()->user()->client_id);
    }

    public function mount()
    {
        $data_tab = config('module.teller.index');
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

        $data_payment_in = config('module.teller.payment-in.index');
        $this->option_payment_in = [];
        foreach ($data_payment_in as $option_payment_in) {
            if ($this->checkPermission($option_payment_in)) {
                $this->option_payment_in[] = $option_payment_in;
            }
        }

        $data_payment_out = config('module.teller.payment-out.index');
        $this->option_payment_out = [];
        foreach ($data_payment_out as $option_payment_out) {
            if ($this->checkPermission($option_payment_out)) {
                $this->option_payment_out[] = $option_payment_out;
            }
        }
    }

    public function clearPaymentIn()
    {
        $this->type_payment_in = '';
    }

    public function clearPaymentOut()
    {
        $this->type_payment_out = '';
    }

    public function render()
    {
        return view('livewire.teller.teller-list')->extends('layouts.main');
    }
}
