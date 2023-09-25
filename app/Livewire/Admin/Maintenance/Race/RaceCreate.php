<?php

namespace App\Livewire\Admin\Maintenance\Race;

use Livewire\Component;
use App\Models\Ref\RefRace;
use App\Models\User;
use WireUi\Traits\Actions;

class RaceCreate extends Component
{
    use Actions;
    public User $User;
    public $race_description;
    public $race_code;
    public $race_status;
    public $race;

    protected $rules = [
        'race_description' => ['required', 'string'],
        'race_code'        => ['required', 'string', 'max:10'],
        'race_status'      => ['nullable', 'boolean'],
    ];

    public function submit()
    {
        $this->validate();

        $check = RefRace::where('coop_id',$this->User->coop_id)->where('code',$this->race_code);
        //where('id',$this->User->id)->

        if($check->doesntExist())
        {
            $race = RefRace::create([
                'description' => trim(strtoupper($this->race_description)),
                'code'        => trim(strtoupper($this->race_code)),
                'coop_id'     => $this->User->coop_id,
                'status'      => $this->race_status == true ? '1' : '0',
                'created_at'  => now(),
                'created_by'  => Auth()->user()->name,
            ]);

            return redirect()->route('race.list');
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
        return redirect()->route('race.list');
    }

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
    }

    public function render()
    {
        return view('livewire.admin.maintenance.race.race-create')->extends('layouts.main');
    }
}
