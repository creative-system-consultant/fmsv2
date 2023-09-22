<?php

namespace App\Livewire\Admin\Maintenance\Education;

use App\Models\Ref\RefEducation;
use Livewire\Component;
use App\Models\User;

class EducationCreate extends Component
{
    public $User;
    public $EducationDescription;
    public $EducationCode;
    public $EducationStatus;
    public $Education;

    protected $rules =[
        'EducationDescription' => ['required', 'string'],
        'EducationCode'        => ['required', 'string'],
        'EducationStatus' => ['nullable','boolean'],
    ];

    public function submit()
    {
        $this->validate();

        $Check = RefEducation::where('coop_id',$this->User->coop_id)->where('code',$this->EducationCode);

        if($Check->doesntExist())
        {
            $Country = RefEducation::create([
                'description' => trim(strtoupper($this->EducationDescription)),
                'code'        => trim(strtoupper($this->EducationCode)),
                'coop_id'     => $this->User->coop_id,
                'status'      => $this->EducationStatus == true ? '1' : '0',
                'created_at'  => now(),
                'created_by'  => Auth()->user()->name,
            ]);

            return redirect()->route('education.list');
        }
        else{
            $this->dialog([

                'title'       => 'Error!',

                'description' => 'Code Already Exists',

                'icon'        => 'error'

            ]);
        }
    }
    public function cancel()
    {
        return redirect()->route('education.list');
    }

    public function mount() {
        $this->User = User::find(auth()->user()->id);
    }

    public function render()
    {
        return view('livewire.admin.maintenance.education.education-create')->extends('layouts.main');
    }
}
