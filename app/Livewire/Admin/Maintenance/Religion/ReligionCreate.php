<?php

namespace App\Livewire\Admin\Maintenance\Religion;

use Livewire\Component;
use App\Models\Ref\RefReligion;
use WireUi\Traits\Actions;
use App\Models\User;


class ReligionCreate extends Component
{
    use Actions;
    
    public $description;
    public $code;
    public $status;
    public $RefReligion;
    public $User;

    protected $rules =[
        'description' => ['required', 'string'],
        'code'        => ['required', 'max:3', 'alpha'],
        'status' => ['nullable','boolean'],
    ];
    protected $messages =[

        'description.required' => 'The religion field is required',
        'code'        => 'The code field is required', 

    ];
    public function submit() {
        $this->validate();
        
        if(RefReligion::where('coop_id',$this->User->coop_id)->where ('code',$this->code)->exists())
        {
            $this->dialog([
                'title'       => 'Error!',
                'description' => 'Data already exist!',
                'icon'        => 'error'
            ]);
        }
        else
        {

        $RefReligion = RefReligion::create([
            'description'     => trim(strtoupper($this->description)),
            'code'            => trim(strtoupper($this->code)),
            'coop_id'         => $this->User->coop_id,
            'status'          => $this->status == true ? '1' : '0',
            'created_at'      => now(),
            'created_by'      => Auth()->user()->name,
        ]);

        

        return redirect()->route('religion.list');
    }
    }
        
    

    public function cancel() {
        return redirect()->route('religion.list');
    }

    public function mount()
    {
        $this->User= User::find(auth()->user()->id);
    }

    

    public function render()
    {
        return view('livewire.admin.maintenance.religion.religion-create')->extends('layouts.main');
    }
}



