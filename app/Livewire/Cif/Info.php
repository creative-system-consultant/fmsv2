<?php

namespace App\Livewire\Cif;

use App\Models\Cif\CifCustomer;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Info extends Component
{
    public $uuid, $name, $cID, $addresses, $customer;
    public $setIndex = 0;

    public function mount()
    {
        $this->customer = CifCustomer::select('name', 'id')->where('uuid', $this->uuid)->first();
        $this->name = $this->customer->name;
        $this->cID = $this->customer->id;

        // Default to the first permitted tab
        foreach (config('module.member-info.cif.index') as $config) {
            if (auth()->user()->can($config['permission'])) {
                $this->setIndex = $config['index'];
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
        // $this->dispatchBrowserEvent('swal', [
        //     'title' => 'Deleted!',
        //     'text'  => 'The detail has been deleted.',
        //     'icon'  => 'success',
        //     'showConfirmButton' => false,
        //     'timer' => 1500,
        // ]);

        // $this->emit('deleteAddressShow', $key);
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
