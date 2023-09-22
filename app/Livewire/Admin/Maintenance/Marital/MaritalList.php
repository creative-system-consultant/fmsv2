<?php

namespace App\Livewire\Admin\Maintenance\Marital;

use Livewire\Component;
use App\Models\Ref\RefMarital;
use WireUi\Traits\Actions;
use App\Models\User;

class MaritalList extends Component
{

    use Actions;
    public $coopId;
    public $RefMarital;

    public function mount()
    {
        $this->coopId = User::find(auth()->user()->id);

        $this->RefMarital = RefMarital::where('coop_id',$this->coopId->coop_id)->get();
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
    
    public function cancel() {
    }

    function ConfirmDelete($id) {

        $data=RefMarital::find($id);
        $data->delete();

        $this->RefMarital = RefMarital::where('coop_id',$this->coopId->coop_id)->get();
    }


    public function render()
    {
        return view('livewire.admin.maintenance.marital.marital-list')->extends('layouts.main');
    }
}
