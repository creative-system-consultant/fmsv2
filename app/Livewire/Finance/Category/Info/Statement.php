<?php

namespace App\Livewire\Finance\Category\Info;

use App\Models\Fms\FmsAccountMaster;
use App\Models\Fms\FmsAccountStatement;
use DB;
use Livewire\Component;
use Livewire\WithPagination;

class Statement extends Component
{
    use WithPagination;

    public $uuid;
    public $startDate, $endDate;

    public function mount()
    {
        $this->startDate    =  '2021-12-31';
        $this->endDate      =  now()->format('Y-m-d');
    }

    public function render()
    {
        $account = FmsAccountMaster::where('uuid', '=', $this->uuid)->orderby('id', 'desc')->first();
        $stmt = FmsAccountStatement::select(
            DB::raw("FMS.uf_get_users_name(client_id, created_by) AS user_name"),
            '*'
        )
            ->where('account_no', $account->account_no)
            ->whereBetween(DB::raw('cast(transaction_date as date)'), [$this->startDate, $this->endDate])
            ->orderBy('id')
            // ->get();
            ->paginate(10);

        // dump($account->account_no);



        $account_stmt = FmsAccountMaster::where('uuid', '=', $this->uuid)->first();

        return view('livewire.finance.category.info.statement', [
            'statements' => $stmt,
            'account_stmt' => $account_stmt
        ]);
    }
}
