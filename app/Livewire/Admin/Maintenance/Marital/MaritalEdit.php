<?php

namespace App\Livewire\Admin\Maintenance\Marital;

use Livewire\Component;
use App\Models\Ref\RefMarital;
use App\Models\User;
use WireUi\Traits\Actions;

class MaritalEdit extends Component
{
    use Actions;
    public $description;
    public $code;
    public $status;
    public $RefMarital;

    protected $rules =[
        'description' => 'required|string',
        'code' => 'required|alpha',
        'status' => 'nullable|boolean',
    ];

    public function update($id)
    {
        $this->validate();

        $User = User::find(auth()->user()->id);

        $check = RefMarital::where('coop_id',$User->coop_id)->where('code',$this->code);

        if($check->exists() == false || $check->value('id') == $id)
        {
            $marital = RefMarital::where('id', $id)->first();

            RefMarital::whereId($id)->update([
                'description'     => trim(strtoupper($this->description)),
                'code'            => trim(strtoupper($this->code)),
                'status'          => $this->status == true ? '1' : '0',
                'updated_at'      => now(),
                'updated_by'      => Auth()->user()->name,
            ]);
            return redirect()->route('marital.list');
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
        return redirect()->route('marital.list');
    }
    

    public function mount($id)
    {
        $this->RefMarital = RefMarital::find($id);
        $this->code = $this->RefMarital->code;
        $this->description = $this->RefMarital->description;
        $this->status = $this->RefMarital->status == 1 ? true:false;
    
    }

    public function render()
    {
        return view('livewire.admin.maintenance.marital.marital-edit')->extends('layouts.main');
    }
}
