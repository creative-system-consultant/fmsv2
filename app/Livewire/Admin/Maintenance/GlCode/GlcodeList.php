<?php

namespace App\Livewire\Admin\Maintenance\Glcode;

use App\Models\Ref\RefGlcode;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\User;

class GlcodeList extends Component
{
    Use Actions;
    public $glcode;
    public $coopId;

    public function mount()
    {
        $this->coopId= User::find(auth()->user()->id);
        $this->glcode = RefGlcode::where('coop_id',$this->coopId->coop_id)->get();
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

        $data = RefGlcode::find($id);
        $data ->delete();

        $this->glcode = RefGlcode::where('coop_id',$this->coopId->coop_id)->get();

    }

    public function cancel()
    {

    }

    public function render()
    {
        return view('livewire.admin.maintenance.glcode.glcode-list')->extends('layouts.main');
    }
}
