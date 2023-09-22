<?php

namespace App\Livewire\Admin\Maintenance\Race;

use App\Models\Ref\RefRace;
use Livewire\Component;
use App\Models\User;
use WireUi\Traits\Actions;

class RaceEdit extends Component
{
    use Actions;
    public $user;
    public $race_description;
    public $race_code;
    public $race_status;
    public $race;

    protected $rules = [
        'race_description' => ['required', 'string'],
        'race_code'        => ['required', 'string'],
        'race_status'      => ['nullable', 'boolean'],
    ];

    public function update($id)
    {
        $this->validate();

        $User = User::find(auth()->user()->id);

        //$check = RefRace::where('id', $user->id)->where('coop_id', $user->coop_id)->where('code',$this->race_code);

        $check = RefRace::where('coop_id',$User->coop_id)->where('code',$this->race_code);

        if($check-> exists() == false || $check->value('id') == $id)
        {
            $race = RefRace::where('id', $id)->first();

            $race->update([
                'description' => trim(strtoupper($this->race_description)),
                'code'        => trim(strtoupper($this->race_code)),
                'status'      => $this->race_status == true ? '1' : '0',
                'updated_at'  => now(),
                'updated_by'  => Auth()->user()->name,
            ]);
            return redirect()->route('race.list');
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
        return redirect()->route('race.list');
    }

    public function mount($id)
    {
        $this->race = RefRace::find($id);
        $this->race_description = $this->race->description;
        $this->race_code = $this->race->code;
        $this->race_status = $this->race->status == 1 ? true : false;
    }

    public function render()
    {
        return view('livewire.admin.maintenance.race.race-edit')->extends('layouts.main');
    }
}
