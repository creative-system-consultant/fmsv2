<?php

namespace App\Livewire\Cif;

use App\Models\Cif\CifCustomer;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Info extends Component
{
    public $uuid, $name, $cID, $addresses, $customer;
    public $setIndex;

    public function mount()
    {
        $this->customer = CifCustomer::select('name', 'id')->where('uuid', $this->uuid)->first();
        $this->name = $this->customer->name;
        $this->cID = $this->customer->id;

        // Default to the first permitted tab
        foreach (config('module.member-info.cif.index') as $config) {
            $hasPermission = auth()->check() && auth()->user()->hasClientSpecificPermission($config['permission'], auth()->user()->client_id);
            if ($hasPermission) {
                $this->setIndex = (int) $config['index'];
                break;
            }
        }
    }

    public function deleteAddress($key)
    {
        $this->addresses                = ($this->customer->addresses) ? $this->customer->addresses->toArray() : 0;

        $id = $this->addresses[$key]['id'];
        $address = $this->customer->addresses->where('id', $id)->first();
        if (isset($address)) {
            $address->update(['deleted_by' => auth()->user()->id]);
            $address->delete();
        }
        unset($this->addresses[$key]);
    }

    public function setState($index)
    {
        $this->setIndex = $index;
    }

    public function render()
    {
        return view('livewire.cif.info')->extends('layouts.main');
    }
}
