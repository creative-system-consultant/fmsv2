<?php

namespace App\Livewire\Cif;

use App\Models\Cif\CifCustomer;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Info extends Component
{
    public $uuid, $name, $cID;
    public $setIndex = 0;

    public function mount()
    {
        $customerName = CifCustomer::select('name', 'id')->where('uuid', $this->uuid)->first();
        $this->name = $customerName->name;
        $this->cID = $customerName->id;
    }

    public function deleteAddress($key)
    {
        $this->emit('deleteAddressShow', $key);
    }

    public function setState($index)
    {
        $this->setIndex = $index;
    }

    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.cif.info');
    }
}
