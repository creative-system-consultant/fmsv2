<?php

namespace App\Livewire\Admin\Maintenance\Country;

use App\Models\Ref\RefCountry;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\User;

class CountryList extends Component
{
    use Actions;
    public $Country;
    public $User;
    
    function delete($id){
        $data = RefCountry::find($id);
        $data->delete();
        $this->Country = RefCountry::where('coop_id',$this->User->coop_id)->get();
    }

    public function mount()
    {
       $this->User= User::find(auth()->user()->id);
       $this->Country = RefCountry::where('coop_id',$this->User->coop_id)->get();
    } 

    public function render()
    {
        return view('livewire.admin.maintenance.country.country-list')->extends('layouts.main');
    }
}
