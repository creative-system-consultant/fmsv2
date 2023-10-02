<?php

namespace App\Livewire\Admin\Maintenance\Title;

use Livewire\Component;
use App\Models\Ref\RefTitle;
use WireUi\Traits\Actions;
use App\Models\User;

class TitleCreate extends Component
{
    use Actions;
    public $description;
    public $code;
    public $status;
    public $User;
    public $RefTitle;


    protected $rules =[
        'description' => ['required', 'string'],
        'code'        => ['required', 'alpha'],
        'status' => ['nullable','boolean'],
    ];

    protected $messages = [
        'description.required' => 'Marital field is required',
    ];

    public function submit() {
        $this->validate();

        $check = RefTitle::where('coop_id',$this->User->coop_id)->where('code',$this->code);

        if($check->doesntExist())
        {
            $RefTitle = RefTitle::create([
                'description'     => trim(strtoupper($this->description)),
                'code'            => trim(strtoupper($this->code)),
                'coop_id'         => $this->User->coop_id,
                'status'          => $this->status == true ? '1' : '0',
                'created_at'      => now(),
                'created_by'      => Auth()->user()->name,
            ]);

            return redirect()->route('title.list');

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
        return redirect()->route('title.list');
    }

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
    }

    public function render()
    {
        return view('livewire.admin.maintenance.title.title-create')->extends('layouts.main');
    }
}
