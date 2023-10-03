<?php

namespace App\Livewire\Admin\Maintenance\State;

use App\Models\Ref\RefState;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\User;


class StateCreate extends Component

{
    use Actions;
     
    public $description;
    public $code;
    public $status;
    public $RefState;
    public $User;

    protected $rules =[
        'description' => ['required', 'string'],
        'code'        => ['required' ,'numeric'],
        'status' => ['nullable','boolean'],
    ];

    

    public function submit() {
        
        $this->validate();
        
        
        if(RefState::where ('coop_id',$this->User->coop_id)->where ('code',$this->code)->exists())
        {
            $this->dialog([
                'title'       => 'Error!',
                'description' => 'Data already exist!',
                'icon'        => 'error'
            ]);
            
        }
        else
        {

        $RefState = RefState::create([
            'description'     => trim(strtoupper($this->description)),
            'code'            => trim(strtoupper($this->code)),
            'coop_id'         => $this->User->coop_id,
            'status'          => $this->status == true ? '1' : '0',
            'created_at'      => now(),
            'created_by'      => Auth()->user()->name,
        ]);

        

        return redirect()->route('state.list');
    }
}
        
    

    public function cancel() {
        return redirect()->route('state.list');
    }

    public function mount()
    {
        $this->User= User::find(auth()->user()->id);
    }

    

    public function render()
    {
        return view('livewire.admin.maintenance.state.state-create')->extends('layouts.main');
    }
}

