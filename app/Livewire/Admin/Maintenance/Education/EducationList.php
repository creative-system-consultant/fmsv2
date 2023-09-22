<?php

namespace App\Livewire\admin\Maintenance\Education;

use App\Models\Ref\RefEducation;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\User;

class EducationList extends Component
{
    use Actions;
    public $Education;
    public $User;

    function delete($id){
        $data = RefEducation::find($id);
        $data->delete();
        $this->Education = RefEducation::where('coop_id',$this->User->coop_id)->get();
    }

    public function mount()
    {
        $this->User= User::find(auth()->user()->id);
        $this->Education = RefEducation::where('coop_id',$this->User->coop_id)->get();
    }

    public function render()
    {
        return view('livewire.admin.maintenance.education.education-list')->extends('layouts.main');
    }
}
