<?php

namespace App\Livewire\Finance\PreDisbursement;

use App\Services\Model\FmsAccountMaster;
use DB;
use Livewire\Component;
use Livewire\WithPagination;


class PreDisbList extends Component
{

    use WithPagination;
    public $search_by1 = 'CIF.CUSTOMERS.name';
    public $search1 = '';

    public $ref_no, $name, $identity_no, $account_no, $description, $approved_limit, $selling_price, $disbursed_amount, $uuid, $instal_amount, $bal_outstanding, $account_master;
    public $result;
    protected $listeners = ['updatestatus'];

    public $clientID;

    public function mount()
    {
        $this->clientID = auth()->user()->client_id;
    }
    protected $rules = [
        'account_master.account_status' => ''
    ];

    //function update status
    public function updatestatus($account_no)
    {

        $data = [
            "account_status" => '11',
            'updated_by' => auth()->user()->id,
            'created_at' => now()
        ];

        FmsAccountMaster::updateAccountData($account_no, $data);

        $this->account_master->update([
            'account_status' => '11',
            'updated_by' => auth()->user()->id,
            'created_at' => now()
        ]);

        $this->dialog()->success('Updated!', 'The detail has been updated.');
    }

    public function render()
    {

        $predisb_list = DB::table("FMS.ACCOUNT_POSITIONS")
            ->select(DB::raw('CIF.CUSTOMERS.name,CIF.CUSTOMERS.staff_no,FMS.MEMBERSHIP.mbr_no,CIF.CUSTOMERS.identity_no,FMS.ACCOUNT_MASTERS.approved_limit,FMS.ACCOUNT_MASTERS.approved_date,FMS.ACCOUNT_MASTERS.pre_disbursement_flag,FMS.ACCOUNT_MASTERS.uuid,FMS.ACCOUNT_MASTERS.account_no,FMS.ACCOUNT_MASTERS.instal_amount,FMS.ACCOUNT_POSITIONS.advance_payment'))
            ->join('FMS.ACCOUNT_MASTERS', 'FMS.ACCOUNT_POSITIONS.account_no', 'FMS.ACCOUNT_MASTERS.account_no')
            ->join('FMS.MEMBERSHIP', 'FMS.ACCOUNT_MASTERS.mbr_no', 'FMS.MEMBERSHIP.mbr_no')
            ->join('CIF.CUSTOMERS', 'FMS.MEMBERSHIP.mbr_no', 'CIF.CUSTOMERS.id')
            ->where(function ($query) {
                $query->where('FMS.ACCOUNT_POSITIONS.disbursed_amount', '=', 0)
                    ->orWhereNull('FMS.ACCOUNT_POSITIONS.disbursed_amount');
            })
            ->where('FMS.ACCOUNT_MASTERS.pre_disbursement_flag', '=', null)
            ->where('FMS.ACCOUNT_MASTERS.account_status', '=', '1')
            ->where('FMS.MEMBERSHIP.client_id', $this->clientID)
            ->where('FMS.ACCOUNT_MASTERS.client_id', $this->clientID)
            ->where('FMS.ACCOUNT_POSITIONS.client_id', $this->clientID)
            ->where('CIF.CUSTOMERS.client_id', $this->clientID)
            ->where($this->search_by1, 'like', '%' . $this->search1 . '%')
            ->orderBy($this->search_by1)
            ->paginate(10);

        // dd($predisb_list);


        return view('livewire.finance.pre-disbursement.pre-disb-list', [
            'predisb_list' => $predisb_list,
        ]);
    }
}
