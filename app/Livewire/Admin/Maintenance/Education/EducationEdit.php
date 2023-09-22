<?php

namespace App\Livewire\admin\Maintenance\Education;

use App\Models\Ref\RefEducation;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\User;
use WireUi\Traits\Actions;

class EducationEdit extends Component
{
    use Actions;
    public $User;
    public $EducationDescription;
    public $EducationCode;
    public $EducationStatus;
    public $Education;

    protected $rules =[
        'EducationDescription' => ['required', 'string'],
        'EducationCode'        => ['required', 'string','unique:App\Models\Ref\RefCountry,code'],
        'EducationStatus' => ['nullable','boolean'],
    ];

    public function update($id)
    { 
        $this->validate();

        $User = User::find(auth()->user()->id);

        $Check = RefEducation::where('coop_id',$User->coop_id)->where('code',$this->CountryCode);

        if($Check->exists() == false || $Check->value('id') == $id)
        {
            $Education = RefEducation::where('id', $id)->first();

            $Education->update([
                'description'     => trim(strtoupper($this->EducationDescription)),
                'code'            => trim(strtoupper($this->EducationCode)),
                'status'          => $this->EducationStatus == true ? '1' : '0',
                'updated_at'      => now(),
                'updated_by'      => Auth()->user()->name,
            ]);
            return redirect()->route('education.list');
        }
        else
        {
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

    public function mount($id)
    {
        $this->Education = RefEducation::find($id);
        $this->EducationDescription = $this->Education->description;
        $this->EducationCode = $this->Education->code;
        $this->EducationStatus = $this->Education->status == 1 ? true:false;
    }

    public function render()
    {
        return view('livewire.admin.maintenance.education.education-edit')->extends('layouts.main');
    }
}
