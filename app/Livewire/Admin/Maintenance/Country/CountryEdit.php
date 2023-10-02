<?php

namespace App\Livewire\Admin\Maintenance\Country;

use App\Models\Ref\RefCountry;
use Livewire\Component;
use App\Models\User;
use WireUi\Traits\Actions;

class CountryEdit extends Component
{
    use Actions;
    public $User;
    public $CountryDescription;
    public $CountryCode;
    public $CountryStatus;
    public $Country;
    public $Check;
    

    protected $rules =[
        'CountryDescription' => ['required', 'string','max:255'],
        'CountryCode'        => ['required', 'string','max:10'],
        'CountryStatus' => ['nullable','boolean'],
    ];

    public function update($id)
    {
        $this->validate();

        $User = User::find(auth()->user()->id);

        $Check = RefCountry::where('coop_id',$User->coop_id)->where('code',$this->CountryCode);

        if($Check->exists() == false || $Check->value('id') == $id)
        {
            $Country = RefCountry::where('id', $id)->first();

            $Country->update([
                'description'     => trim(strtoupper($this->CountryDescription)),
                'code'            => trim(strtoupper($this->CountryCode)),
                'status'          => $this->CountryStatus == true ? '1' : '0',
                'updated_at'      => now(),
                'updated_by'      => Auth()->user()->name,
            ]);
            return redirect()->route('country.list');
        }
        else
        {
            $this->dialog([

                'title'       => 'Error!',

                'description' => 'Code Already Exists',

                'icon'        => 'error'

            ]);
        }
    }

    public function cancel()
    {
        return redirect()->route('country.list');
    }

    public function mount($id)
    {
        $this->Country = RefCountry::find($id);
        $this->CountryDescription = $this->Country->description;
        $this->CountryCode = $this->Country->code;
        $this->CountryStatus = $this->Country->status == 1 ? true:false;
    }

    public function deb()
    {
        dd([
            'country' => $this->Country,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.maintenance.country.country-edit')->extends('layouts.main');
    }
}
