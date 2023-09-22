<?php

namespace App\Livewire\Admin\Maintenance\State;

use Livewire\Component;
use App\Models\Ref\RefState;
use App\Models\User;

class StateList extends Component
{
    public $RefState;
    public $coopId;

    public function mount()
    {
        $this->coopId= User::find(auth()->user()->id);
        $this->RefState = RefState::where('coop_id',$this->coopId->coop_id)->get();
    }

    public function delete($id)
    {
        $data=RefState::find($id);
        $data->delete();
        $this->RefState = RefState::where('coop_id',$this->coopId->coop_id)->get();

       
    }

    public function render()
    {
        return view('livewire.admin.maintenance.state.state-list')->extends('layouts.main');
    }
}
