<?php

namespace App\Livewire\Admin\Maintenance\Glcode;

use App\Models\Ref\RefGlcode;
use Livewire\Component;
use App\Models\User;
use WireUi\Traits\Actions;


class GlcodeEdit extends Component
{
    use Actions;
    public $user;
    public $glcode_description;
    public $glcode_code;
    public $glcode_status;
    public $glcode;

    protected $rules = [
        'glcode_description' => ['required', 'string'],
        'glcode_code'        => ['required', 'string'],
        'glcode_status'      => ['nullable', 'boolean'],
    ];

    public function update($id)
    {
        $this->validate();

        $User = User::find(auth()->user()->id);

        $check = RefGlcode::where('coop_id',$User->coop_id)->where('code',$this->glcode_code);

        if($check-> exists() == false || $check->value('id') == $id)
        {
            $glcode = RefGlcode::where('id', $id)->first();

            $glcode->update([
                'description' => trim(strtoupper($this->glcode_description)),
                'code'        => trim(strtoupper($this->glcode_code)),
                'status'      => $this->glcode_status == true ? '1' : '0',
                'updated_at'  => now(),
                'updated_by'  => Auth()->user()->name,
            ]);
            return redirect()->route('glcode.list');
        }

        else
        {
            $this->dialog([

                'title'       => 'Error!',

                'description' => 'Code Exists',

                'icon'        => 'error'
            ]);
        }

    }

    public function cancel()
    {
        return redirect()->route('glcode.list');
    }

    public function mount($id)
    {
        $this->glcode = RefGlcode::find($id);
        $this->glcode_description = $this->glcode->description;
        $this->glcode_code = $this->glcode->code;
        $this->glcode_status = $this->glcode->status == 1 ? true : false;
    }

    public function render()
    {
        return view('livewire.admin.maintenance.glcode.glcode-edit')->extends('layouts.main');
    }
}
