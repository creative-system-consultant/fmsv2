<?php

namespace App\Livewire\Admin\Maintenance\Glcode;

use Livewire\Component;
use App\Models\Ref\RefGlcode;
use App\Models\User;
use WireUi\Traits\Actions;

class GlcodeCreate extends Component
{
    use Actions;
    public User $User;
    public $glcode_description;
    public $glcode_code;
    public $glcode_status;
    public $glcode;

    protected $rules = [
        'glcode_description' => ['required', 'string'],
        'glcode_code'        => ['required', 'string', 'max:10'],
        'glcode_status'      => ['nullable', 'boolean'],
    ];

    public function submit()
    {
        $this->validate();

        $check = RefGlcode::where('coop_id',$this->User->coop_id)->where('code',$this->glcode_code);

        if($check->doesntExist())
        {
            $glcode = RefGlcode::create([
                'description' => trim(strtoupper($this->glcode_description)),
                'code'        => trim(strtoupper($this->glcode_code)),
                'coop_id'     => $this->User->coop_id,
                'status'      => $this->glcode_status == true ? '1' : '0',
                'created_at'  => now(),
                'created_by'  => Auth()->user()->name,
            ]);

            return redirect()->route('glcode.list');
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

    public function cancel()
    {
        return redirect()->route('glcode.list');
    }

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
    }

    public function render()
    {
        return view('livewire.admin.maintenance.glcode.glcode-create')->extends('layouts.main');
    }
}
