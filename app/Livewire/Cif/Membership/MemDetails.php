<?php

namespace App\Livewire\Cif\Membership;

use App\Models\Cif\CifCustomer;
use App\Models\Fms\Membership;
use App\Models\Ref\RefMemStatus;
use App\Models\Ref\RefPaymentType;
use App\Services\General\PopupService;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\Actions;

class MemDetails extends Component
{
    use Actions;

    public $client_id, $id, $uuid, $ref_no, $name, $identity_no, $apply_date, $start_date, $end_date, $total_share, $monthly_share, $last_purchase_amount,
        $last_purchase_date, $last_selling_amount, $last_selling_date, $total_contribution, $monthly_contribution, $last_payment_amount,
        $last_payment_date, $last_withdraw_amount, $last_withdraw_date, $total_withdraw_amount, $staff_no, $status_id, $status_change_date,
        $type_id, $data_status, $created_by, $updated_by, $deleted_by, $created_at, $updated_at, $approved_retirement_date,
        $effective_retirement_date, $retirement_flag, $entrance_fee, $entrance_fee_date, $introducer_name, $introducer_mbrid, $introducer_icno,
        $introducer_flag, $no_of_withdrawal, $source, $tkk_amount, $tkk_last_pay_dt, $va_account,
        $payment_type, $staffno_payer, $withdraw_share_pv, $withdraw_con_pv, $kebajikan_pv, $khairat_pv, $closed_mbr_pv;

    public $introducers, $membershipInfo, $customerInfo;
    public $email, $mobileNo, $monthlyContribution;
    public $disabled = true;
    public $paymentType;
    public $paymentTypeOptions = [];

    public function mount()
    {
        $clientID = auth()->user()->client_id;

        $this->paymentType = RefPaymentType::where('client_id', $clientID)->get();
        $this->paymentTypeOptions = $this->paymentType->map(function ($paymentType) {
            return ['name' => $paymentType->description, 'id' => $paymentType->id];
        });

        $this->customerInfo = CifCustomer::with('fmsMembership', 'fmsMembership.introducerList')->where('uuid', $this->uuid)->where('client_id', $clientID)->first();
        $this->membershipInfo = $this->customerInfo->fmsMembership;
        $this->introducers  = $this->customerInfo->fmsMembership->introducerList;
        $memberStatus = RefMemStatus::select('description')->where('mbr_status', $this->membershipInfo->mbr_status)->first();

        $this->client_id = $this->customerInfo->client_id ?? "";
        $this->id = $this->customerInfo->id ?? "";
        $this->name = $this->customerInfo->name ?? "";
        $this->identity_no = $this->customerInfo->identity_no ?? "";
        $this->ref_no = $this->membershipInfo->mbr_no ?? "";
        $this->apply_date = $this->membershipInfo->apply_date ?? "";
        $this->start_date = $this->membershipInfo->start_date ?? "";
        $this->end_date = $this->membershipInfo->end_date ?? "";
        $this->total_share = $this->membershipInfo->total_share ?? "";
        $this->monthly_share = $this->membershipInfo->monthly_share ?? "";
        $this->last_purchase_amount = $this->membershipInfo->last_purchase_amount ?? "";
        $this->last_purchase_date = $this->membershipInfo->last_purchase_date ?? "";
        $this->last_selling_amount = $this->membershipInfo->last_selling_amount ?? "";
        $this->last_selling_date = $this->membershipInfo->last_selling_date ?? "";
        $this->total_contribution = $this->membershipInfo->total_contribution ?? "";
        $this->monthly_contribution = $this->membershipInfo->monthly_contribution ?? "";
        $this->last_payment_amount = $this->membershipInfo->last_payment_amount ?? "";
        $this->last_payment_date = $this->membershipInfo->last_payment_date ?? "";
        $this->last_withdraw_amount = $this->membershipInfo->last_withdraw_amount ?? "";
        $this->last_withdraw_date = $this->membershipInfo->last_withdraw_date ?? "";
        $this->total_withdraw_amount = $this->membershipInfo->total_withdraw_amount ?? "";
        $this->staff_no = $this->membershipInfo->staff_no ?? "";
        $this->status_id = $memberStatus->description ?? '';
        $this->status_change_date = $this->membershipInfo->status_change_date ?? "";
        $this->type_id = $this->membershipInfo->type_id ?? "";
        $this->data_status = $this->membershipInfo->data_status ?? "";
        $this->created_by = $this->membershipInfo->created_by ?? "";
        $this->updated_by = $this->membershipInfo->updated_by ?? "";
        $this->deleted_by = $this->membershipInfo->deleted_by ?? "";
        $this->created_at = $this->membershipInfo->created_at ?? "";
        $this->updated_at = $this->membershipInfo->updated_at ?? "";
        $this->approved_retirement_date = $this->membershipInfo->approved_retirement_date ?? "";
        $this->effective_retirement_date = $this->membershipInfo->effective_retirement_date ?? "";
        $this->retirement_flag = $this->membershipInfo->retirement_flag ?? "";
        $this->entrance_fee = $this->membershipInfo->register_fee ?? "";
        $this->entrance_fee_date = $this->membershipInfo->start_date ?? "";
        $this->no_of_withdrawal = $this->membershipInfo->no_of_withdrawal ?? "";
        $this->source = $this->membershipInfo->source ?? "";
        $this->tkk_amount = $this->membershipInfo->tkk_amount ?? "";
        $this->tkk_last_pay_dt = $this->membershipInfo->tkk_last_pay_dt ?? "";
        $this->va_account = $this->membershipInfo->va_account ?? "";
        $this->payment_type = $this->membershipInfo->payment_type ?? "";
        $this->staffno_payer = $this->membershipInfo->staffno_payer ?? "";
        $this->withdraw_share_pv = $this->membershipInfo->withdraw_share_pv ?? "";
        $this->withdraw_con_pv = $this->membershipInfo->withdraw_con_pv ?? "";
        $this->kebajikan_pv = $this->membershipInfo->kebajikan_pv ?? "";
        $this->khairat_pv = $this->membershipInfo->khairat_pv ?? "";
        $this->closed_mbr_pv = $this->membershipInfo->closed_mbr_pv ?? "";
    }

    public function editDetail()
    {
        $this->disabled = !$this->disabled;
    }

    public function saveDetail()
    {
        PopupService::confirm($this, 'confirmSaveData', 'Save Updated Data?', 'Are you sure to proceed with the action?');
    }

    public function confirmSaveData()
    {
        dd('saved');
        // $this->customerInfo->update([
        //     'name' => $this->name,
        //     'identity_no' => $this->identity_no,
        //     'bank_id' => (int) $this->bank_id,
        //     'bank_acct_no' => $this->bank_acct_no
        // ]);

        // $this->membershipInfo->update([
        //     'approved_retirement_date' => $this->approved_retirement_date,
        //     'effective_retirement_date' => $this->effective_retirement_date,
        //     'mbr_status' => $this->status_id
        // ]);

        // $this->disabled = true;
    }

    public function render()
    {
        return view('livewire.cif.membership.mem-details')->extends('layouts.main');
    }
}
