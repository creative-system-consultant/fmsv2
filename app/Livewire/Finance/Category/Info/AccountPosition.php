<?php

namespace App\Livewire\Finance\Category\Info;

use App\Models\Fms\FmsAccountMaster;
use App\Models\Fms\FmsAccountPosition;
use Livewire\Component;

class AccountPosition extends Component
{
    public $uuid, $account_master, $account_position;

    public function render()
    {
        $this->account_master = FmsAccountMaster::where('uuid', '=', $this->uuid)->first();
        $this->account_position = FmsAccountPosition::where('account_no', '=', $this->account_master->account_no)->first();
        return view('livewire.finance.category.info.account-position');
    }
}
