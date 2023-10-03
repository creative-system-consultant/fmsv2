<?php

namespace App\Livewire\Admin\Maintenance\Country;

use App\Models\Ref\RefCountry;
use Livewire\Component;
use App\Models\User;
use WireUi\Traits\Actions;

class CountryCreate extends Component
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

    public function submit()
    {
        $this->validate();

        $Check = RefCountry::where('coop_id',$this->User->coop_id)->where('code',$this->CountryCode);

        if($Check->doesntExist())
        {
            $Country = RefCountry::create([
                'description' => trim(strtoupper($this->CountryDescription)),
                'code'        => trim(strtoupper($this->CountryCode)),
                'coop_id'     => $this->User->coop_id,
                'status'      => $this->CountryStatus == true ? '1' : '0',
                'created_at'  => now(),
                'created_by'  => Auth()->user()->name,
            ]);

            return redirect()->route('country.list');
        }
        else{
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

    public function mount() {
        $this->User = User::find(auth()->user()->id);
    }

  
    public function render()
    {
        return view('livewire.admin.maintenance.country.country-create')->extends('layouts.main');
    }
}
