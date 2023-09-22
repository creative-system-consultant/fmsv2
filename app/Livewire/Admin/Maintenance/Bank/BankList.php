<?php

namespace App\Livewire\Admin\Maintenance\Bank;

use App\Models\Ref\RefBank;
use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\User;

class BankList extends Component
{
    use Actions;
    public $Bank;
    public $User;

    function delete($id){
        $data = RefBank::find($id);
        $data->delete();
        $this->Bank = RefBank::where('coop_id',$this->User->coop_id)->get();
    }

    public function mount()
    {
        $this->User= User::find(auth()->user()->id);
        $this->Bank = RefBank::where('coop_id',$this->User->coop_id)->get();
    }

    public function render()
    {
        return view('livewire.admin.maintenance.bank.bank-list')->extends('layouts.main');
    }
}
