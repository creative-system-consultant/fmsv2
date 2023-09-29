<?php

namespace App\Livewire\Admin\Maintenance\Religion;

use Livewire\Component;
use App\Models\Ref\RefReligion;
use WireUi\Traits\Actions;
use App\Models\User;

class ReligionEdit extends Component


{
    use Actions;
    public $description;
    public $code;
    public $status;
    public $RefReligion;

    protected $rules =[
        'description' => ['required', 'string'],
        'code'        => ['required','alpha','max:3'],
        'status' => ['nullable','boolean'],
    ];

   

    public function update($id)
    {
    $this->validate();

  
    
    $User = User::find(auth()->user()->id);

        $check = RefReligion::where('coop_id',$User->coop_id)->where('code',$this->code);
    
    if($check->exists() == false || $check->value('id') == $id)
    {
        $RefReligion = RefReligion::where('id', $id)->first();

        RefReligion::whereId($id)->update([
            'description'     => trim(strtoupper($this->description)),
            'code'            => trim(strtoupper($this->code)),
            'status'          => $this->status == true ? '1' : '0',
            'updated_at'      => now(),
            'updated_by'      => Auth()->user()->name,
        ]);
        return redirect()->route('religion.list');
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
    return redirect()->route('religion.list');
}



public function mount($id)
{
    $this->RefReligion = RefReligion::find($id);
    $this->code = $this->RefReligion->code;
    $this->description = $this->RefReligion->description;
    $this->status = $this->RefReligion->status == 1 ? true:false;
    

    
}


    public function render()
    {
        return view('livewire.admin.maintenance.religion.religion-edit')->extends('layouts.main');
    }
}
