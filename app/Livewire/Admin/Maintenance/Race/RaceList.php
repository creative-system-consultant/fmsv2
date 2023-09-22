<?php

namespace App\Livewire\Admin\Maintenance\Race;

use App\Models\Ref\RefRace;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\User;

class RaceList extends Component
{

    Use Actions;
    public  $race;
    public $coopId;

    public function mount()
    {
        $this->coopId= User::find(auth()->user()->id);
        $this->race = RefRace::where('coop_id',$this->coopId->coop_id)->get();
    }

    public function delete($id)
    {

    $this->dialog()->confirm([

        'title'       => 'Are you Sure?',

        'description' => 'Save the information?',

        'icon'        => 'question',

        'accept'      => [

            'label'  => 'Yes, save it',

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

        $data = RefRace::find($id);
        $data ->delete();

        $this->race = RefRace::all();

    }

    public function cancel()
    {

    }

    public function render()
    {
        return view('livewire.admin.maintenance.race.race-list')->extends('layouts.main');
    }

}
