<?php

namespace App\Livewire\Cif\Info;

use App\Models\Cif\Address as CifAddress;
use App\Models\Cif\CifCustomer;
use App\Models\Ref\AddressType;
use App\Models\Ref\RefCountry;
use App\Models\Ref\RefState;
use Livewire\Component;

class Address extends Component
{
    public $uuid, $editAddress;
    public $states, $countries, $addressTypes, $add1, $add2, $add3, $postcode, $town, $addresses;


    protected $rules = [
        'addresses.*.address1'                      => '',
        'addresses.*.postcode'                  => '',
        'addresses.*.town'                      => '',
        'addresses.*.state_id'                  => 'required',
        'addresses.*.country_id'                => '',
        'addresses.*.address_type_id'           => 'required|distinct',
        'addresses.*.phone'                     => '',
        'addresses.*.fax'                       => '',
        'addresses.*.mail_flag'                 => '',
    ];

    protected $messages = [
        'addresses.*.address_type_id.required'  => 'Address Type field is required.',
        'addresses.*.state_id.required'         => 'State field is required',
    ];

    protected $listeners = ['deleteAddressShow'];

    public function deleteAddressShow($key)
    {
        dd('noice');
    }

    public function mount()
    {
        $customer = CifCustomer::where('uuid', $this->uuid)->first();

        $this->addresses                = ($customer->addresses) ? $customer->addresses->toArray() : 0;
        $this->states                   = RefState::all();
        $this->countries                = RefCountry::all();
        $this->addressTypes             = AddressType::whereIn('id', [2, 3, 11])->get();

        // if ($address) {
        //     $this->add1 = $address->address1;
        //     $this->add2 = $address->address2;
        //     $this->add3 = $address->address3;
        //     $this->postcode = $address->postcode;
        //     $this->town = $address->town;
        //     $this->states = $address->state->description;
        //     $this->countries = $address->country->description;
        // }
    }

    public function editAddressbtn()
    {
        $this->editAddress = true;
    }

    public function render()
    {
        return view('livewire.cif.info.address')->extends('layouts.main');
    }
}
