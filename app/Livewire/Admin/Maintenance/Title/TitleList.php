<?php

namespace App\Livewire\Admin\Maintenance\Title;

use Livewire\Component;
use App\Models\Ref\RefTitle;
use WireUi\Traits\Actions;
use App\Models\User;

class TitleList extends Component
{
    use Actions;
    public $coopId;
    public $RefTitle;

    public function mount()
    {
        $this->coopId = User::find(auth()->user()->id);

        $this->RefTitle = RefTitle::where('coop_id',$this->coopId->coop_id)->get();
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

        $data=RefTitle::find($id);
        $data->delete();

        $this->RefTitle = RefTitle::where('coop_id',$this->coopId->coop_id)->get();
    }
    public function render()
    {
        return view('livewire.admin.maintenance.title.title-list')->extends('layouts.main');
    }
}
