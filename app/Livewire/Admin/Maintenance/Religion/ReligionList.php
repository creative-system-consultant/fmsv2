<?php

namespace App\Livewire\Admin\Maintenance\Religion;

use Livewire\Component;
use App\Models\Ref\RefReligion;
use App\Models\User;

class ReligionList extends Component
{
    public $RefReligion;
    public $coopId;

    public function mount()
    {
        $this->coopId= User::find(auth()->user()->id);
        $this->RefReligion = RefReligion::where('coop_id',$this->coopId->coop_id)->get();
    }

    public function delete($id)
    {
        $data=RefReligion::find($id);
        $data->delete();

        $this->RefReligion = RefReligion::where('coop_id',$this->coopId->coop_id)->get();

      
    }

    public function render()
    {
        return view('livewire.admin.maintenance.religion.religion-list')->extends('layouts.main');
    }
}
