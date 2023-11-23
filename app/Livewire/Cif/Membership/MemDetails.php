<?php

namespace App\Livewire\Cif\Membership;

use App\Models\Cif\CifCustomer;
use Livewire\Component;

class MemDetails extends Component
{

    public $client_id, $id, $uuid, $ref_no, $apply_date, $start_date, $end_date, $total_share, $monthly_share, $last_purchase_amount,
        $last_purchase_date, $last_selling_amount, $last_selling_date, $total_contribution, $monthly_contribution, $last_payment_amount,
        $last_payment_date, $last_withdraw_amount, $last_withdraw_date, $total_withdraw_amount, $staff_no, $status_id, $status_change_date,
        $type_id, $data_status, $created_by, $updated_by, $deleted_by, $created_at, $updated_at, $deleted_at, $approved_retirement_date,
        $effective_retirement_date, $retirement_flag, $entrance_fee, $entrance_fee_date, $introducer_name, $introducer_mbrid, $introducer_icno,
        $introducer_flag, $no_of_withdrawal, $source, $tkk_amount, $tkk_last_pay_dt, $va_account, $year_tabung_khirat, $amt_tabung_khirat,
        $payment_type, $staffno_payer, $withdraw_share_pv, $withdraw_con_pv, $kebajikan_pv, $khairat_pv, $closed_mbr_pv;


    public $email, $mobileNo, $monthlyContribution;

    public $editDetail = false;

    public function mount()
    {
        $clientID = auth()->user()->client_id;

        $CustomerInfo = CifCustomer::where('uuid', $this->uuid)->where('client_id', $clientID)->first();
        $MembershipInfo = $CustomerInfo->fmsMembership;
        // dd($CustomerInfo);
        if ($CustomerInfo) {
            $this->client_id = $CustomerInfo->client_id ?? "null";
            $this->id = $CustomerInfo->id ?? "null";
            $this->uuid = $CustomerInfo->uuid ?? "null";
            $this->ref_no = $MembershipInfo->mbr_no ?? "null";
            $this->apply_date = $MembershipInfo->apply_date ?? "null";
            $this->start_date = $MembershipInfo->start_date ?? "null";
            $this->end_date = $MembershipInfo->end_date ?? "null";
            $this->total_share = $MembershipInfo->total_share ?? "null";
            $this->monthly_share = $MembershipInfo->monthly_share ?? "null";
            $this->last_purchase_amount = $MembershipInfo->last_purchase_amount ?? "null";
            $this->last_purchase_date = $MembershipInfo->last_purchase_date ?? "null";
            $this->last_selling_amount = $MembershipInfo->last_selling_amount ?? "null";
            $this->last_selling_date = $MembershipInfo->last_selling_date ?? "null";
            $this->total_contribution = $MembershipInfo->total_contribution ?? "null";
            $this->monthly_contribution = $MembershipInfo->monthly_contribution ?? "null";
            $this->last_payment_amount = $MembershipInfo->last_payment_amount ?? "null";
            $this->last_payment_date = $MembershipInfo->last_payment_date ?? "null";
            $this->last_withdraw_amount = $MembershipInfo->last_withdraw_amount ?? "null";
            $this->last_withdraw_date = $MembershipInfo->last_withdraw_date ?? "null";
            $this->total_withdraw_amount = $MembershipInfo->total_withdraw_amount ?? "null";
            $this->staff_no = $MembershipInfo->staff_no ?? "null";
            $this->status_id = $MembershipInfo->status_id ?? "null";
            $this->status_change_date = $MembershipInfo->status_change_date ?? "null";
            $this->type_id = $MembershipInfo->type_id ?? "null";
            $this->data_status = $MembershipInfo->data_status ?? "null";
            $this->created_by = $MembershipInfo->created_by ?? "null";
            $this->updated_by = $MembershipInfo->updated_by ?? "null";
            $this->deleted_by = $MembershipInfo->deleted_by ?? "null";
            $this->created_at = $MembershipInfo->created_at ?? "null";
            $this->updated_at = $MembershipInfo->updated_at ?? "null";
            $this->deleted_at = $MembershipInfo->deleted_at ?? "null";
            $this->approved_retirement_date = $MembershipInfo->approved_retirement_date ?? "null";
            $this->effective_retirement_date = $MembershipInfo->effective_retirement_date ?? "null";
            $this->retirement_flag = $MembershipInfo->retirement_flag ?? "null";
            $this->entrance_fee = $MembershipInfo->entrance_fee ?? "null";
            $this->entrance_fee_date = $MembershipInfo->entrance_fee_date ?? "null";
            $this->introducer_name = $MembershipInfo->introducer_name ?? "null";
            $this->introducer_mbrid = $MembershipInfo->introducer_mbrid ?? "null";
            $this->introducer_icno = $MembershipInfo->introducer_icno ?? "null";
            $this->introducer_flag = $MembershipInfo->introducer_flag ?? "null";
            $this->no_of_withdrawal = $MembershipInfo->no_of_withdrawal ?? "null";
            $this->source = $MembershipInfo->source ?? "null";
            $this->tkk_amount = $MembershipInfo->tkk_amount ?? "null";
            $this->tkk_last_pay_dt = $MembershipInfo->tkk_last_pay_dt ?? "null";
            $this->va_account = $MembershipInfo->va_account ?? "null";
            $this->year_tabung_khirat = $MembershipInfo->year_tabung_khirat ?? "null";
            $this->amt_tabung_khirat = $MembershipInfo->amt_tabung_khirat ?? "null";
            $this->payment_type = $MembershipInfo->payment_type ?? "null";
            $this->staffno_payer = $MembershipInfo->staffno_payer ?? "null";
            $this->withdraw_share_pv = $MembershipInfo->withdraw_share_pv ?? "null";
            $this->withdraw_con_pv = $MembershipInfo->withdraw_con_pv ?? "null";
            $this->kebajikan_pv = $MembershipInfo->kebajikan_pv ?? "null";
            $this->khairat_pv = $MembershipInfo->khairat_pv ?? "null";
            $this->closed_mbr_pv = $MembershipInfo->closed_mbr_pv ?? "null";
        } else {
            // redirect(route('home'));
        }
    }
    function editDetail()
    {
        $this->editDetail = true;
    }


    public function render()
    {
        return view('livewire.cif.membership.mem-details')->extends('layouts.main');
    }
}
