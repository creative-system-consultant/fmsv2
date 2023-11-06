<?php

namespace App\Livewire\Finance\Category\Info;

use App\Models\Fms\FmsAccountMaster;
use Livewire\Component;

class RepaymentSchedule extends Component
{
    public $uuid;
    public $clientID;

    public function mount()
    {
        $this->clientID = auth()->user()->client_id;
    }

    public function render()
    {
        $account = FmsAccountMaster::where('uuid', '=', $this->uuid)
            ->where('client_id', $this->clientID)
            ->first();

        return view('livewire.finance.category.info.repayment-schedule', [
            'schedules' => $account->repayment_schedule($this->clientID)
                ->orderBy('instalment_no')
                ->get()
        ]);
    }
}
