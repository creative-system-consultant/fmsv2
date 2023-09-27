<?php

namespace App\Livewire\Admin\Maintenance\Religion;

use Livewire\Component;
use App\Models\Ref\RefReligion;
use App\Models\User;
use WireUi\Traits\Actions;

class ReligionList extends Component
{
    use Actions;
    public $RefReligion;
    public $coopId;

    public function mount()
    {
        $this->coopId= User::find(auth()->user()->id);
        $this->RefReligion = RefReligion::where('coop_id',$this->coopId->coop_id)->get();
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

        $data = RefReligion::find($id);
        $data ->delete();

        $this->RefReligion = RefReligion::where('coop_id',$this->coopId->coop_id)->get();

    }

    public function cancel()
    {

    }


    public function render()
    {
        return view('livewire.admin.maintenance.religion.religion-list')->extends('layouts.main');
    }
}
