<?php

namespace App\Livewire\Admin\Maintenance\Bank;

use App\Models\REF\RefBank;
use Livewire\Component;
use App\Models\User;
use WireUi\Traits\Actions;

class BankCreate extends Component
{
    use Actions;
    public $User;
    public $BankDescription;
    public $BankCode;
    public $BankStatus;
    public $Bank;

    protected $rules =[
        'BankDescription' => ['required', 'string','max:255'],
        'BankCode'        => ['required', 'string','max:4'],
        'BankStatus' => ['nullable','boolean'],
    ];

    public function submit()
    {
        $this->validate();

        $check = RefBank::where('coop_id',$this->User->coop_id)->where('code',$this->BankCode);

        if($check->doesntExist())
        {
            $bank = RefBank::create([
                'description' => trim(strtoupper($this->BankDescription)),
                'code'        => trim(strtoupper($this->BankCode)),
                'coop_id'     => $this->User->coop_id,
                'status'      => $this->BankStatus == true ? '1' : '0',
                'created_at'  => now(),
                'created_by'  => Auth()->user()->name,
            ]);
    

            return redirect()->route('bank.list');     
        }
        else{
            $this->dialog([

                'title'       => 'Error!',

                'description' => 'Code Already Exists',

                'icon'        => 'error'

            ]);
        }
    }

    public function cancel()
    {
        return redirect()->route('bank.list');
    }

    public function mount() {
        $this->User = User::find(auth()->user()->id);
    }
    public function render()
    {
        return view('livewire.admin.maintenance.bank.bank-create')->extends('layouts.main');
    }
}
