<?php

namespace App\Livewire\Admin\Maintenance\State;

use Livewire\Component;
use App\Models\Ref\RefState;
use App\Models\User;
use WireUi\Traits\Actions;

class StateList extends Component
{
    use Actions;
    public $RefState;
    public $coopId;

    public function mount()
    {
        $this->coopId= User::find(auth()->user()->id);
        $this->RefState = RefState::where('coop_id',$this->coopId->coop_id)->get();
    }

    public function delete($id)
    {
        $this->dialog()->confirm([

            'title'       => 'Are you Sure?',

            'description' => 'Delete the information?',

            'icon'        => 'question',

            'accept'      => [

                'label'  => 'Yes, delete it',

                'method' => 'ConfirmDelete',

                'params' => $id,

            ],

            'reject' =>
            [

                'label'  => 'No, cancel',

                'method' => 'cancel',
            ],

           ]);
    }

    public function ConfirmDelete($id)
    {

        $data = RefState::find($id);
        $data ->delete();

        $this->RefState = RefState::where('coop_id',$this->coopId->coop_id)->get();

    }

    public function cancel()
    {

    }

    public function render()
    {
        return view('livewire.admin.maintenance.state.state-list')->extends('layouts.main');
    }
}
