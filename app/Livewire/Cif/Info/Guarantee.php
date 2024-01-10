<?php

namespace App\Livewire\Cif\Info;

use App\Models\Cif\CifCustomer;
use App\Models\Fms\Membership;
use DB;
use Livewire\Component;

class Guarantee extends Component
{
    public $customer, $uuid, $MembershipInfo;
    public $Guarantor, $Guarantee;

    public function mount()
    {
        $clientID = auth()->user()->client_id;
        $this->customer = CifCustomer::where('uuid', $this->uuid)->where('client_id', $clientID)->first();
        $this->MembershipInfo = Membership::where('cif_id', $this->customer->id)->first();
        $clientID = auth()->user()->client_id;

        $this->Guarantor = DB::table('FMS.GUARANTOR_LIST')
            ->select([
                DB::raw('(SELECT name FROM CIF.CUSTOMERS WHERE CIF.CUSTOMERS.id = FMS.GUARANTOR_LIST.guarantor_mbr_id) AS name'),
                DB::raw('FMS.GUARANTOR_LIST.account_no, FMS.GUARANTOR_LIST.mbr_id as guarantor_mbr_id ,FMS.ACCOUNT_POSITIONS.bal_outstanding,
                FMS.uf_get_account_status(FMS.ACCOUNT_MASTERS.client_id,CIF.CUSTOMERS.id) AS account_status,
                FMS.ACCOUNT_MASTERS.account_no,
                FMS.ACCOUNT_POSITIONS.expiry_date,
                FMS.GUARANTOR_LIST.status_effective_date,FMS.uf_get_product(FMS.ACCOUNT_MASTERS.client_id, FMS.ACCOUNT_MASTERS.product_id) AS product'),
            ])
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.mbr_no', '=', 'FMS.GUARANTOR_LIST.guarantor_mbr_id')
            ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', '=', 'FMS.MEMBERSHIP.cif_id')
            ->join('FMS.ACCOUNT_POSITIONS', 'FMS.ACCOUNT_POSITIONS.account_no', '=', 'FMS.GUARANTOR_LIST.account_no')
            ->join('FMS.ACCOUNT_MASTERS', 'FMS.ACCOUNT_MASTERS.account_no', '=', 'FMS.ACCOUNT_POSITIONS.account_no')
            ->where('FMS.GUARANTOR_LIST.client_id', $clientID)
            ->where('FMS.ACCOUNT_MASTERS.client_id', $clientID)
            ->where('FMS.ACCOUNT_POSITIONS.client_id', $clientID)
            ->where('FMS.MEMBERSHIP.client_id', $clientID)
            ->where('CIF.CUSTOMERS.client_id', $clientID)
            ->where('FMS.GUARANTOR_LIST.mbr_id', $this->MembershipInfo->mbr_no)

            ->orderBy('FMS.ACCOUNT_MASTERS.account_status')
            ->get();

        // dump($this->MembershipInfo->mbr_no);

        $this->Guarantee = DB::table('FMS.GUARANTOR_LIST')
            ->select([
                DB::raw('(SELECT name FROM CIF.CUSTOMERS WHERE CIF.CUSTOMERS.id = FMS.GUARANTOR_LIST.guarantor_mbr_id) AS name'),
                DB::raw('FMS.GUARANTOR_LIST.mbr_id, FMS.ACCOUNT_POSITIONS.bal_outstanding, FMS.uf_get_account_status(FMS.ACCOUNT_MASTERS.client_id,CIF.CUSTOMERS.id) AS account_status
                ,FMS.ACCOUNT_MASTERS.account_no, FMS.ACCOUNT_POSITIONS.expiry_date, FMS.GUARANTOR_LIST.status_effective_date, FMS.ACCOUNT_MASTERS.instal_amount,
                FMS.uf_get_product(FMS.ACCOUNT_MASTERS.client_id, FMS.ACCOUNT_MASTERS.product_id) AS product,
                FMS.uf_get_guarantor_status(FMS.GUARANTOR_LIST.guarantor_status,FMS.GUARANTOR_LIST.guarantor_no) AS guarantor_status'),
            ])
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP.mbr_no', '=', 'FMS.GUARANTOR_LIST.guarantor_mbr_id')
            ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', '=', 'FMS.MEMBERSHIP.cif_id')
            ->join('FMS.ACCOUNT_POSITIONS', 'FMS.ACCOUNT_POSITIONS.account_no', '=', 'FMS.GUARANTOR_LIST.account_no')
            ->join('FMS.ACCOUNT_MASTERS', 'FMS.ACCOUNT_MASTERS.account_no', '=', 'FMS.ACCOUNT_POSITIONS.account_no')
            ->where('FMS.GUARANTOR_LIST.guarantor_mbr_id', $this->MembershipInfo->mbr_no)
            ->where('FMS.GUARANTOR_LIST.client_id', $clientID)
            ->where('FMS.ACCOUNT_MASTERS.client_id', $clientID)
            ->where('FMS.ACCOUNT_POSITIONS.client_id', $clientID)
            ->where('FMS.MEMBERSHIP.client_id', $clientID)
            ->where('CIF.CUSTOMERS.client_id', $clientID)
            ->orderBy('FMS.ACCOUNT_MASTERS.account_status')
            ->get();

        // dd($this->Guarantee);
    }

    public function render()
    {
        return view('livewire.cif.info.guarantee')->extends('layouts.main');
    }
}
