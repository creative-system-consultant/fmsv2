<?php

namespace App\Livewire\Admin\Maintenance\Relationship;

use Livewire\Component;
use App\Models\Ref\RefRelationship;
use WireUi\Traits\Actions;
use app\Models\User;


class RelationshipCreate extends Component
{
    use Actions;

    public $description;
    public $code;
    public $status;
    public $RefRelationship;
    public $User;


    protected $rules =[
        'description' => ['required', 'string'],
        'code'        => ['required','max:3', 'alpha'],
        'status' => ['nullable','boolean'],
    ];

    protected $messages =[
        'description.required' => 'The relationship field is required',
        'code' => 'The code field is required',

    ];

    public function submit() {
        $this->validate();

       
        if(RefRelationship::where ('coop_id',$this->User->coop_id)->where ('code',$this->code)->exists())
        {
            $this->dialog([
                'title'       => 'Error!',
                'description' => 'Data already exist!',
                'icon'        => 'error'
            ]);
        }
        else
        {

        $RefRelationship = RefRelationship::create([
            'description'     => trim(strtoupper($this->description)),
            'code'            => trim(strtoupper($this->code)),
            'coop_id'         => $this->User->coop_id,
            'status'          => $this->status == true ? '1' : '0',
            'created_at'      => now(),
            'created_by'      => Auth()->user()->name,
        ]);

        

        return redirect()->route('relationship.list');
    }
    }
        
    

    public function cancel() {
        return redirect()->route('relationship.list');
    }

    public function mount()
    {
       
        $this->User= User::find(auth()->user()->id);
        
    }

    

    public function render()
    {
        return view('livewire.admin.maintenance.relationship.relationship-create')->extends('layouts.main');
    }
}

