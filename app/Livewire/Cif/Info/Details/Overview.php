<?php

namespace App\Livewire\Cif\Info\Details;

use App\Models\Cif\CifCustomer;
use App\Models\Fms\Membership;
use App\Models\Ref\RefBank;
use App\Models\Ref\RefMemStatus;
use App\Models\Ref\RefPaymentType;
use Livewire\Component;

class Overview extends Component
{
    public $uuid, $staff_no, $ref_no, $name, $identity_no, $cust_status, $status_id, $apply_date, $start_date, $status_change_date, $approved_retirement_date, $effective_retirement_date, $entrance_fee, $entrance_fee_date, $bank_id, $bank_acct_no, $payment_type, $staffno_payer, $va_account, $clientID;

    public function mount()
    {
        $this->clientID = auth()->user()->client_id;
        $customerInfo = CifCustomer::where('uuid', $this->uuid)->where('client_id', $this->clientID)->first();
        $membershipInfo = Membership::where('cif_id', $customerInfo->id)->first();
        $memberStatus = RefMemStatus::select('description')->where('mbr_status', $membershipInfo->mbr_status)->first();
        $bank_name = RefBank::select('description')->where('id',  $customerInfo->bank_id)->first();
        $paymentType = RefPaymentType::select('description')->where('id', $membershipInfo->payment_type)->first();

        $this->staff_no = $customerInfo->staff_no;
        $this->ref_no = $membershipInfo->mbr_no;
        $this->name = $customerInfo->name;
        $this->identity_no = $customerInfo->identity_no;
        $this->cust_status = ($customerInfo->cust_status == 'Y' ? 'Members' : 'Non Members');
        $this->status_id = $memberStatus->description;
        $this->apply_date = $membershipInfo->apply_date;
        $this->start_date = $membershipInfo->start_date;
        $this->status_change_date = $membershipInfo->status_change_date;
        $this->approved_retirement_date = $membershipInfo->approved_retirement_date;
        $this->effective_retirement_date = $membershipInfo->effective_retirement_date;
        $this->entrance_fee = $membershipInfo->entrance_fee;
        $this->entrance_fee_date = $membershipInfo->entrance_fee_date;
        $this->bank_id = $bank_name->description ?? '';
        $this->bank_acct_no = $customerInfo->bank_acct_no;
        $this->payment_type = $paymentType->description ?? '';
        $this->staffno_payer = $customerInfo->staffno_payer;
        $this->va_account = $membershipInfo->va_account;
    }

    public function render()
    {
        return view('livewire.cif.info.details.overview');
    }
}
