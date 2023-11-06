<?php

namespace App\Livewire\Finance\ClosedAccount;

use DB;
use Livewire\Component;
use Livewire\WithPagination;

class ClosedAccountList extends Component
{
    use WithPagination;
    public $search_by3 = 'CIF.customers.name';
    public $search3 = '';
    public $clientID;

    public function mount()
    {
        $this->clientID = auth()->user()->client_id;
    }

    public function render()
    {

        $closed_acc = DB::table('CIF.CUSTOMERS')
            ->select(DB::raw('FMS.MEMBERSHIP.mbr_no,FMS.MEMBERSHIP.staff_no,CIF.CUSTOMERS.name,CIF.CUSTOMERS.identity_no,FMS.ACCOUNT_MASTERS.account_no,CIF.ACCOUNT_STATUSES.description,FMS.ACCOUNT_MASTERS.approved_limit,FMS.ACCOUNT_MASTERS.selling_price,FMS.ACCOUNT_POSITIONS.disbursed_amount,FMS.ACCOUNT_MASTERS.uuid,FMS.ACCOUNT_MASTERS.instal_amount,FMS.ACCOUNT_POSITIONS.bal_outstanding,FMS.ACCOUNT_MASTERS.start_disbursed_date,FMS.ACCOUNT_POSITIONS.advance_payment'))
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.mbr_no', 'CIF.CUSTOMERS.id')
            ->join('FMS.ACCOUNT_MASTERS', 'FMS.MEMBERSHIP.mbr_no', 'FMS.ACCOUNT_MASTERS.mbr_no')
            ->join('FMS.ACCOUNT_POSITIONS', 'FMS.ACCOUNT_POSITIONS.account_no', 'FMS.ACCOUNT_MASTERS.account_no')
            ->leftJoin('CIF.ACCOUNT_STATUSES', 'FMS.ACCOUNT_MASTERS.account_status', 'CIF.ACCOUNT_STATUSES.id')
            ->whereNotNull('FMS.ACCOUNT_POSITIONS.disbursed_amount')
            ->whereIn('FMS.ACCOUNT_MASTERS.account_status', array(2))
            ->where('FMS.MEMBERSHIP.client_id', $this->clientID)
            ->where('FMS.ACCOUNT_MASTERS.client_id', $this->clientID)
            ->where('FMS.ACCOUNT_POSITIONS.client_id', $this->clientID)
            ->where('CIF.CUSTOMERS.client_id', $this->clientID)
            ->where($this->search_by3, 'like', '%' . $this->search3 . '%')
            ->orderBy($this->search_by3)
            ->paginate(10);

        return view('livewire.finance.closed-account.closed-account-list', [
            'closed_acc'            => $closed_acc,
        ]);
    }
}
