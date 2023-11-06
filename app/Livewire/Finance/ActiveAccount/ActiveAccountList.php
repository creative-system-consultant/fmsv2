<?php

namespace App\Livewire\Finance\ActiveAccount;

use DB;
use Livewire\Component;
use Livewire\WithPagination;

class ActiveAccountList extends Component
{
    use WithPagination;
    public $search_by2 = 'CIF.CUSTOMERS.name';
    public $search2 = '';
    public $clientID;

    public function mount()
    {
        $this->clientID = auth()->user()->client_id;
    }
    public function render()
    {
        $account_active = DB::table('CIF.CUSTOMERS')
            ->select(DB::raw('FMS.MEMBERSHIP.mbr_no,FMS.MEMBERSHIP.staff_no,CIF.CUSTOMERS.name,CIF.CUSTOMERS.identity_no,FMS.ACCOUNT_MASTERS.account_no,CIF.ACCOUNT_STATUSES.description,FMS.ACCOUNT_MASTERS.approved_limit,FMS.ACCOUNT_MASTERS.selling_price,FMS.ACCOUNT_POSITIONS.disbursed_amount,FMS.ACCOUNT_MASTERS.uuid,FMS.ACCOUNT_MASTERS.instal_amount,FMS.ACCOUNT_POSITIONS.bal_outstanding,FMS.ACCOUNT_MASTERS.start_disbursed_date,FMS.ACCOUNT_POSITIONS.advance_payment'))
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.cif_id', 'CIF.CUSTOMERS.id')
            ->join('FMS.ACCOUNT_MASTERS', 'FMS.MEMBERSHIP.mbr_no', 'FMS.ACCOUNT_MASTERS.mbr_no')
            ->join('FMS.ACCOUNT_POSITIONS', 'FMS.ACCOUNT_POSITIONS.account_no', 'FMS.ACCOUNT_MASTERS.account_no')
            ->leftJoin('CIF.ACCOUNT_STATUSES', 'FMS.ACCOUNT_MASTERS.account_status', 'CIF.ACCOUNT_STATUSES.id')
            ->whereNotNull('FMS.ACCOUNT_POSITIONS.disbursed_amount')
            ->where('FMS.MEMBERSHIP.client_id', $this->clientID)
            ->where('FMS.ACCOUNT_MASTERS.client_id', $this->clientID)
            ->where('FMS.ACCOUNT_POSITIONS.client_id', $this->clientID)
            ->where('CIF.CUSTOMERS.client_id', $this->clientID)
            ->whereIn('FMS.ACCOUNT_MASTERS.account_status', array(1, 7, 8, 10))
            ->paginate(10);


        return view('livewire.finance.active-account.active-account-list', [
            'account_active'            => $account_active,
        ]);
    }
}
