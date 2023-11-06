<?php

namespace App\Livewire\Cif\Info;

use App\Models\Cif\Address as CifAddress;
use App\Models\Cif\CifCustomer;
use App\Models\Ref\AddressType;
use App\Models\Ref\RefCountry;
use App\Models\Ref\RefState;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Address extends Component
{
    public $uuid, $editAddress = true;
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
    }

    public function editAddressbtn()
    {
        $this->editAddress = false;
    }

    public function saveAddress()
    {

        $this->rules['addresses.*.address_type_id'] = [
            'required',
            function ($attribute, $value, $fail) {
                $ids = collect($this->addresses)->pluck('address_type_id');
                $ids_except_11 = $ids->filter(function ($id) {
                    return $id != 11;
                });
                if ($ids_except_11->duplicates()->isNotEmpty()) {
                    $fail('Make sure the field address type not duplicate value.');
                }
            }
        ];


        if (array_sum(array_column($this->addresses, 'mail_flag')) == 1) {
            foreach ($this->addresses as $index => $address) {

                CifAddress::where('id', $address['id'])->update([
                    'mail_flag'         => $address['mail_flag'] == true ? '1' : 0,
                    'address_type_id'   => $address['address_type_id'],
                    'address1'          => $address['address1'],
                    'address2'          => $address['address2'],
                    'address3'          => $address['address3'],
                    'postcode'          => $address['postcode'],
                    'town'              => $address['town'],
                    'state_id'          => $address['state_id'],
                    'country_id'        => $address['country_id'],
                    'phone'             => $address['phone'],
                    'fax'               => $address['fax'],
                    'updated_by'        => auth()->user()->id,
                    'updated_at'        => date("Y-m-d h:i:sa"),
                ]);





                if (isset($address['id'])) {
                    CifAddress::where('id', $address['id'])->update([
                        'mail_flag'         => $address['mail_flag'] == true ? '1' : 0,
                        'address_type_id'   => $address['address_type_id'],
                        'address1'          => $address['address1'],
                        'address2'          => $address['address2'],
                        'address3'          => $address['address3'],
                        'postcode'          => $address['postcode'],
                        'town'              => $address['town'],
                        'state_id'          => $address['state_id'],
                        'country_id'        => $address['country_id'],
                        'phone'             => $address['phone'],
                        'fax'               => $address['fax'],
                        'updated_by'        => auth()->user()->id,
                        'updated_at'        => date("Y-m-d h:i:sa"),
                        // 'institute_id'      => auth()->user()->group->institute_id,
                    ]);
                } else {
                    CifAddress::create([
                        'cust_id'            => $address['ref_id'],
                        'address_type_id'   => $address['address_type_id'],
                        'created_by'        => $address['created_by'],
                        'mail_flag'         => $address['mail_flag'],
                        'address1'          => $address['address1'],
                        'address2'          => $address['address2'],
                        'address3'          => $address['address3'],
                        'postcode'          => $address['postcode'],
                        'town'              => $address['town'],
                        'state_id'          => $address['state_id'],
                        'country_id'        => $address['country_id'],
                        'phone'             => $address['phone'],
                        'fax'               => $address['fax'],
                        'updated_by'        => auth()->user()->id,
                        'updated_at'        => date("Y-m-d h:i:sa"),
                        'institute_id'      => auth()->user()->group->institute_id,
                    ]);
                }
            }

            return redirect()->to('/cif/info/' . $this->uuid);
        }
    }

    public function render()
    {
        return view('livewire.cif.info.address')->extends('layouts.main');
    }
}
