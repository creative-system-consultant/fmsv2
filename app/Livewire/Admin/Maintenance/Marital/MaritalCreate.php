<?php

namespace App\Livewire\Admin\Maintenance\Marital;

use Livewire\Component;
use App\Models\Ref\RefMarital;
use WireUi\Traits\Actions;
use App\Models\User;

class MaritalCreate extends Component
{
    use Actions;
    public $description;
    public $code;
    public $status;
    public $User;
    public $RefMarital;

    protected $rules =[
        'description' => ['required', 'string'],
        'status'      => ['nullable','boolean'],
        'code'        => ['required', 'alpha', 'max:2'],
    ];

    protected $messages = [
        'description.required' => 'Marital field is required',
    ];

    public function submit() {
        
        $this->validate();

        
        $check = RefMarital::where('coop_id',$this->User->coop_id)->where('code',$this->code);

        if($check->doesntExist())
        {
            $RefMarital = RefMarital::create([
                'description'     => trim(strtoupper($this->description)),
                'code'            => trim(strtoupper($this->code)),
                'coop_id'         => $this->User->coop_id,
                'status'          => $this->status == true ? '1' : '0',
                'created_at'      => now(),
                'created_by'      => Auth()->user()->name,
            ]);

            return redirect()->route('marital.list');

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
        return redirect()->route('marital.list');
    }

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);

    }

    public function render()
    {
        return view('livewire.admin.maintenance.marital.marital-create')->extends('layouts.main');
    }
}
