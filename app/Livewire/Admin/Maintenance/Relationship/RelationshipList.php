<?php

namespace App\Livewire\Admin\Maintenance\Relationship;


use Livewire\Component;
use App\Models\Ref\RefRelationship;
use App\Models\User;
use WireUi\Traits\Actions;


class RelationshipList extends Component
{   
    use Actions;
    public $RefRelationship;
    public $coopId;

    public function mount()
    {
        $this->coopId= User::find(auth()->user()->id);
        $this->RefRelationship = RefRelationship::where('coop_id',$this->coopId->coop_id)->get();
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

        $data = RefRelationship::find($id);
        $data ->delete();

        $this->RefRelationship = RefRelationship::where('coop_id',$this->coopId->coop_id)->get();

    }

    public function cancel()
    {

    }

    public function render()
    {
        return view('livewire.admin.maintenance.relationship.relationship-list')->extends('layouts.main');
    }
}
