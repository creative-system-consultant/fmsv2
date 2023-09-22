<?php

namespace App\Livewire\Admin\Maintenance\Gender;

use Livewire\Component;
use App\Models\Ref\RefGender;
use WireUi\Traits\Actions;
use App\Models\User;

class GenderList extends Component
{

    use Actions;
    public $coopId;
    public $RefGender;

    public function mount()
    {
        $this->coopId = User::find(auth()->user()->id);

        $this->RefGender = RefGender::where('coop_id',$this->coopId->coop_id)->get();
    }

    public function delete($id)
    {
        $this->dialog()->confirm([

            'title'       => 'Are you Sure?',

            'description' => 'Save the information?',

            'icon'        => 'question',

            'accept'      => [

                'label'  => 'Delete',

                'method' => 'ConfirmDelete',

                'params' => $id,

            ],

            'reject' => [

                'label'  => 'No, cancel',

                'method' => 'cancel',

            ],

        ]);

        
    }

    function ConfirmDelete($id) {
        $data=RefGender::find($id);
        $data->delete();

        $this->RefGender = RefGender::where('coop_id',$this->coopId->coop_id)->get();
        
    }

    public function cancel() {
    }

    public function render()
    {
        return view('livewire.admin.maintenance.gender.gender-list')->extends('layouts.main');
    }
}
