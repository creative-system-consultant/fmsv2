<?php

namespace App\Livewire\Admin\Maintenance\Bank;

use App\Models\Ref\RefBank;
use Livewire\Component;
use App\Models\User;
use WireUi\Traits\Actions;

class BankEdit extends Component
{
    use Actions;
    public $User;
    public $BankDescription;
    public $BankCode;
    public $BankStatus;
    public $Bank;
    public $Check;

    protected $rules =[
        'BankDescription' => ['required', 'string','max:255'],
        'BankCode'        => ['required', 'string'],
        'BankStatus' => ['nullable','boolean'],
    ];

    public function update($id)
    {
        $this->validate();

        $User = User::find(auth()->user()->id);

        $Check = RefBank::where('coop_id',$User->coop_id)->where('code',$this->BankCode);

        if($Check->exists() == false || $Check->value('id') == $id)
        {
            $Bank = RefBank::where('id', $id)->first();

            $Bank->update([
                'description'     => trim(strtoupper($this->BankDescription)),
                'code'            => trim(strtoupper($this->BankCode)),
                'status'          => $this->BankStatus == true ? '1' : '0',
                'updated_at'      => now(),
                'updated_by'      => Auth()->user()->name,
            ]);
            return redirect()->route('bank.list');
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
        return redirect()->route('bank.list');
    }

    public function mount($id)
    {
        $this->Bank = RefBank::find($id);
        $this->BankDescription = $this->Bank->description;
        $this->BankCode = $this->Bank->code;
        $this->BankStatus = $this->Bank->status == 1 ? true:false;
    }
    public function render()
    {
        return view('livewire.admin.maintenance.bank.bank-edit')->extends('layouts.main');
    }
}
