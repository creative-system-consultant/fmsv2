<?php

namespace App\Livewire\Admin\Maintenance\Relationship;

use Livewire\Component;
use App\Models\Ref\RefRelationship;
use WireUi\Traits\Actions;
use App\Models\User;


class RelationshipEdit extends Component


{
    use Actions;
    public $description;
    public $code;
    public $status;
    public $RefRelationship;

    protected $rules =[
        'description' => ['required', 'string'],
        'code'        => ['required','max:3', 'alpha'],
        'status' => ['nullable','boolean'],
    ];

    public function update($id)
    {
    $this->validate();
    

 
    $User = User::find(auth()->user()->id);

    $check = RefRelationship::where('coop_id',$User->coop_id)->where('code',$this->code);
    if($check->exists() == false || $check->value('id') == $id)
    {
        $RefRelationship = RefRelationship::where('id', $id)->first();

        RefRelationship::whereId($id)->update([
            'description'     => trim(strtoupper($this->description)),
            'code'            => trim(strtoupper($this->code)),
            'status'          => $this->status == true ? '1' : '0',
            'updated_at'      => now(),
            'updated_by'      => Auth()->user()->name,
        ]);
        return redirect()->route('relationship.list');
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
    return redirect()->route('relationship.list');
}



public function mount($id)
{
    $this->RefRelationship = RefRelationship::find($id);
    $this->code = $this->RefRelationship->code;
    $this->description = $this->RefRelationship->description;
    $this->status = $this->RefRelationship->status == 1 ? true:false;
 
    
  
    
}


    public function render()
    {
        return view('livewire.admin.maintenance.relationship.relationship-edit')->extends('layouts.main');
    }
}
