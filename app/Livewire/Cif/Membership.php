<?php

namespace App\Livewire\Cif;

use App\Models\Cif\CifCustomer;
use Livewire\Component;

class Membership extends Component
{
    public $uuid, $name, $cID, $clientID;
    public $setIndex;

    public function mount()
    {
        $this->clientID = auth()->user()->client_id;
        $customerName = CifCustomer::select('name', 'id')->where('uuid', $this->uuid)->where('client_id', $this->clientID)->first();
        $this->name = $customerName->name;
        $this->cID = $customerName->id;

        // Default to the first permitted tab
        foreach (config('module.member-info.member.index') as $config) {
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
        return view('livewire.cif.membership')->extends('layouts.main');
    }
}
