<?php

namespace App\Livewire\Cif\Info\Details;

use App\Models\Cif\CifCustomer;
use App\Models\Fms\Membership;
use App\Models\Ref\RefBank;
use App\Models\Ref\RefMemStatus;
use App\Models\Ref\RefPaymentType;
use App\Services\General\PopupService;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\Actions;

class Overview extends Component
{
    public $disabled = true;
    public $customerInfo;
    public $membershipInfo;
    public $uuid, $staff_no, $ref_no, $name, $identity_no, $cust_status, $status_id, $apply_date, $start_date, $status_change_date, $approved_retirement_date, $effective_retirement_date, $entrance_fee, $entrance_fee_date, $bank_id, $bank_acct_no, $payment_type_id, $staffno_payer_id, $va_account, $clientID;
    public $banks;
    public $bankOptions = [];
    public $paymentType;
    public $paymentTypeOptions = [];

    public function mount()
    {
        $this->clientID = auth()->user()->client_id;

        // Transform banks data to match the select options format
        $this->banks = RefBank::where('client_id', $this->clientID)->get();
        $this->bankOptions = $this->banks->map(function ($bank) {
            return ['name' => $bank->description, 'id' => $bank->id];
        })->toArray();

        // Transform payment type data to match the select options format
        $this->paymentType = RefPaymentType::where('client_id', $this->clientID)->get();
        $this->paymentTypeOptions = $this->paymentType->map(function ($paymentType) {
            return ['name' => $paymentType->description, 'id' => $paymentType->id];
        })->toArray();

        $this->customerInfo = CifCustomer::where('uuid', $this->uuid)->where('client_id', $this->clientID)->first();
        $this->membershipInfo = Membership::where('cif_id', $this->customerInfo->id)->where('client_id', $this->clientID)->first();
        $memberStatus = RefMemStatus::select('description')->where('mbr_status', $this->membershipInfo->mbr_status)->where('client_id', $this->clientID)->first();

        $this->staff_no = $this->customerInfo->staff_no;
        $this->ref_no = $this->membershipInfo->mbr_no;
        $this->name = $this->customerInfo->name;
        $this->identity_no = $this->customerInfo->identity_no;
        $this->cust_status = ($this->customerInfo->cust_status == 'Y' ? 'Members' : 'Non Members');
        $this->status_id = $memberStatus->description;
        $this->apply_date = $this->membershipInfo->apply_date;
        $this->start_date = $this->membershipInfo->start_date;
        $this->status_change_date = $this->membershipInfo->status_change_date;
        $this->approved_retirement_date = $this->membershipInfo->approved_retirement_date;
        $this->effective_retirement_date = $this->membershipInfo->effective_retirement_date;
        $this->entrance_fee = $this->membershipInfo->entrance_fee;
        $this->entrance_fee_date = $this->membershipInfo->entrance_fee_date;
        $this->bank_id = $this->customerInfo->bank_id;
        $this->bank_acct_no = $this->customerInfo->bank_acct_no;
        $this->payment_type_id = $this->membershipInfo->payment_type;
        $this->staffno_payer_id = $this->membershipInfo->staffno_payer;
        $this->va_account = $this->membershipInfo->va_account;
    }

    #[On('edit')]
    public function editData()
    {
        $this->disabled = false;
    }

    #[On('save')]
    public function saveData()
    {
        $this->customerInfo->update([
            'name' => $this->name,
            'identity_no' => $this->identity_no,
            'bank_id' => (int) $this->bank_id,
            'bank_acct_no' => $this->bank_acct_no
        ]);

        $this->membershipInfo->update([
            'approved_retirement_date' => $this->approved_retirement_date,
            'effective_retirement_date' => $this->effective_retirement_date,
            'payment_type' => (int) $this->payment_type_id,
            'staffno_payer' => $this->staffno_payer_id
        ]);

        $this->disabled = true;
    }

    public function render()
    {
        return view('livewire.cif.info.details.overview');
    }
}
