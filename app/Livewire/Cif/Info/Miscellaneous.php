<?php

namespace App\Livewire\Cif\Info;

use App\Models\Cif\CifCustomer;
use App\Models\Fms\FmsMiscAccount;
use App\Models\Fms\FmsMiscStatement;
use DB;
use Livewire\Component;

class Miscellaneous extends Component
{
    public $customer, $uuid, $miscacc;
    public $startDateMisc, $endDateMisc;

    public function mount()
    {
        $clientID = auth()->user()->client_id;
        $this->customer = CifCustomer::where('uuid', $this->uuid)->where('client_id', $clientID)->first();
        $this->startDateMisc    =  '2021-12-31';
        $this->endDateMisc      =  now()->format('Y-m-d');
    }

    public function render()
    {
        $this->miscacc = FmsMiscAccount::where('mbr_no', $this->customer->membership->mbr_no)->first();

        $MiscStmt = FmsMiscStatement::with('transaction')
            ->select(DB::raw('createdby = 1'))
            ->where('mbr_no', $this->customer->ref_no)
            ->whereBetween(DB::raw('cast(transaction_date as date)'), [$this->startDateMisc, $this->endDateMisc])
            ->orderby('id', 'asc')
            // ->get();
            ->paginate(10);




        return view('livewire.cif.info.miscellaneous', [
            'MiscStmt' => $MiscStmt
        ]);
    }
}
