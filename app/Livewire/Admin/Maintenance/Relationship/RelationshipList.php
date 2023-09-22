<?php

namespace App\Livewire\Admin\Maintenance\Relationship;

use Livewire\Component;
use App\Models\Ref\RefRelationship;
use App\Models\User;

class RelationshipList extends Component
{
    public $RefRelationship;
    public $coopId;

    public function mount()
    {
        $this->coopId= User::find(auth()->user()->id);
        $this->RefRelationship = RefRelationship::where('coop_id',$this->coopId->coop_id)->get();
    }

    public function delete($id)
    {
        $data=RefRelationship::find($id);
        $data->delete();
        $this->RefRelationship = RefRelationship::where('coop_id',$this->coopId->coop_id)->get();
        
    }

    public function render()
    {
        return view('livewire.admin.maintenance.relationship.relationship-list')->extends('layouts.main');
    }
}
