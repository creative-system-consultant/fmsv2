<?php

namespace App\Livewire\Admin\Maintenance\Gender;

use Livewire\Component;
use App\Models\Ref\RefGender;
use App\Models\User;
use WireUi\Traits\Actions;

class GenderEdit extends Component
{
    use Actions;
    public $description;
    public $code;
    public $status;
    public $RefGender;

    protected $rules =[
        'description' => ['required', 'string'],
        'status' => ['nullable','boolean'],
        'code'        => ['required', 'alpha'],
    ];

    public function update($id)
    {
        $this->validate();

        $User = User::find(auth()->user()->id);

        $check = RefGender::where('coop_id',$User->coop_id)->where('code',$this->code);

        if($check->exists() == false || $check->value('id') == $id)
        {
            $marital = RefGender::where('id', $id)->first();

            RefGender::whereId($id)->update([
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
        return redirect()->route('gender.list');
    }
    

    public function mount($id)
    {
        $this->RefGender = RefGender::find($id);
        $this->code = $this->RefGender->code;
        $this->description = $this->RefGender->description;
        $this->status = $this->RefGender->status == 1 ? true:false;
    }


    public function render()
    {
        return view('livewire.admin.maintenance.gender.gender-edit')->extends('layouts.main');
    }
}
