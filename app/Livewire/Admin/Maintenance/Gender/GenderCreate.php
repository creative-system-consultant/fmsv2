<?php

namespace App\Livewire\Admin\Maintenance\Gender;

use Livewire\Component;
use App\Models\Ref\RefGender;
use WireUi\Traits\Actions;
use App\Models\User;

class GenderCreate extends Component
{
    use Actions;
    public $description;
    public $code;
    public $status;
    public $User;
    public $RefGender;

    protected $rules =[
        'description' => ['required', 'string'],
        'code'        => ['required', 'alpha', 'max:2'],
        'status' => ['nullable','boolean'],
    ];

    protected $messages = [
        'description.required' => 'Gender field is required',
    ];

    public function submit() {
        $this->validate();

        $check = RefGender::where('coop_id',$this->User->coop_id)->where('code',$this->code);

        if($check->doesntExist())
        {
            $RefGender = RefGender::create([
                'description'     => trim(strtoupper($this->description)),
                'code'            => trim(strtoupper($this->code)),
                'coop_id'         => $this->User->coop_id,
                'status'          => $this->status == true ? '1' : '0',
                'created_at'      => now(),
                'created_by'      => Auth()->user()->name,
            ]);

            return redirect()->route('gender.list');

        }
        else
        {
            $this->dialog([

                'title'       => 'Error!',
    
                'description' => 'Data Exists',
    
                'icon'        => 'error'
    
            ]);
        }  
    }

    public function cancel() {
        return redirect()->route('gender.list');
    }

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
    }


    public function render()
    {
        return view('livewire.admin.maintenance.gender.gender-create')->extends('layouts.main');
    }
}
