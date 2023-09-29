<?php

namespace App\Livewire\Admin\Maintenance\State;

use Livewire\Component;
use App\Models\Ref\RefState;
use WireUi\Traits\Actions;
use App\Models\User;

class StateEdit extends Component


{
    use Actions;
    public $description;
    public $code;
    public $status;
    public $RefState;

    protected $rules =[
        'description' => ['required', 'string'],
        'code'        => ['required','numeric'],
        'status' => ['nullable','boolean'],
    ];

   

    public function update($id)
    {
    $this->validate();

  
  
    $User = User::find(auth()->user()->id);

        $check = RefState::where('coop_id',$User->coop_id)->where('code',$this->code);

    if($check->exists() == false || $check->value('id') == $id)
    {
        $RefState = RefState::where('id', $id)->first();

        RefState::whereId($id)->update([
            'description'     => trim(strtoupper($this->description)),
            'code'            => trim(strtoupper($this->code)),
            'status'          => $this->status == true ? '1' : '0',
            'updated_at'      => now(),
            'updated_by'      => Auth()->user()->name,
        ]);
        return redirect()->route('state.list');
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

public function cancel() {
    return redirect()->route('state.list');
}



public function mount($id)
{
    $this->RefState = RefState::find($id);
    $this->code = $this->RefState->code;
    $this->description = $this->RefState->description;
    $this->status = $this->RefState->status == 1 ? true:false;
  

    
}


    public function render()
    {
        return view('livewire.admin.maintenance.state.state-edit')->extends('layouts.main');
    }
}
