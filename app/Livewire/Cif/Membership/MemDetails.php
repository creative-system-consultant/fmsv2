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
        $CustomerInfo = CifCustomer::where('uuid', $this->uuid)->first();
        // dd($CustomerInfo);
        if ($CustomerInfo) {
            $this->client_id = $CustomerInfo->client_id ?? "null";
            $this->id = $CustomerInfo->id ?? "null";
            $this->uuid = $CustomerInfo->uuid ?? "null";
            $this->ref_no = $CustomerInfo->ref_no ?? "null";
            $this->apply_date = $CustomerInfo->apply_date ?? "null";
            $this->start_date = $CustomerInfo->start_date ?? "null";
            $this->end_date = $CustomerInfo->end_date ?? "null";
            $this->total_share = $CustomerInfo->total_share ?? "null";
            $this->monthly_share = $CustomerInfo->monthly_share ?? "null";
            $this->last_purchase_amount = $CustomerInfo->last_purchase_amount ?? "null";
            $this->last_purchase_date = $CustomerInfo->last_purchase_date ?? "null";
            $this->last_selling_amount = $CustomerInfo->last_selling_amount ?? "null";
            $this->last_selling_date = $CustomerInfo->last_selling_date ?? "null";
            $this->total_contribution = $CustomerInfo->total_contribution ?? "null";
            $this->monthly_contribution = $CustomerInfo->monthly_contribution ?? "null";
            $this->last_payment_amount = $CustomerInfo->last_payment_amount ?? "null";
            $this->last_payment_date = $CustomerInfo->last_payment_date ?? "null";
            $this->last_withdraw_amount = $CustomerInfo->last_withdraw_amount ?? "null";
            $this->last_withdraw_date = $CustomerInfo->last_withdraw_date ?? "null";
            $this->total_withdraw_amount = $CustomerInfo->total_withdraw_amount ?? "null";
            $this->staff_no = $CustomerInfo->staff_no ?? "null";
            $this->status_id = $CustomerInfo->status_id ?? "null";
            $this->status_change_date = $CustomerInfo->status_change_date ?? "null";
            $this->type_id = $CustomerInfo->type_id ?? "null";
            $this->data_status = $CustomerInfo->data_status ?? "null";
            $this->created_by = $CustomerInfo->created_by ?? "null";
            $this->updated_by = $CustomerInfo->updated_by ?? "null";
            $this->deleted_by = $CustomerInfo->deleted_by ?? "null";
            $this->created_at = $CustomerInfo->created_at ?? "null";
            $this->updated_at = $CustomerInfo->updated_at ?? "null";
            $this->deleted_at = $CustomerInfo->deleted_at ?? "null";
            $this->approved_retirement_date = $CustomerInfo->approved_retirement_date ?? "null";
            $this->effective_retirement_date = $CustomerInfo->effective_retirement_date ?? "null";
            $this->retirement_flag = $CustomerInfo->retirement_flag ?? "null";
            $this->entrance_fee = $CustomerInfo->entrance_fee ?? "null";
            $this->entrance_fee_date = $CustomerInfo->entrance_fee_date ?? "null";
            $this->introducer_name = $CustomerInfo->introducer_name ?? "null";
            $this->introducer_mbrid = $CustomerInfo->introducer_mbrid ?? "null";
            $this->introducer_icno = $CustomerInfo->introducer_icno ?? "null";
            $this->introducer_flag = $CustomerInfo->introducer_flag ?? "null";
            $this->no_of_withdrawal = $CustomerInfo->no_of_withdrawal ?? "null";
            $this->source = $CustomerInfo->source ?? "null";
            $this->tkk_amount = $CustomerInfo->tkk_amount ?? "null";
            $this->tkk_last_pay_dt = $CustomerInfo->tkk_last_pay_dt ?? "null";
            $this->va_account = $CustomerInfo->va_account ?? "null";
            $this->year_tabung_khirat = $CustomerInfo->year_tabung_khirat ?? "null";
            $this->amt_tabung_khirat = $CustomerInfo->amt_tabung_khirat ?? "null";
            $this->payment_type = $CustomerInfo->payment_type ?? "null";
            $this->staffno_payer = $CustomerInfo->staffno_payer ?? "null";
            $this->withdraw_share_pv = $CustomerInfo->withdraw_share_pv ?? "null";
            $this->withdraw_con_pv = $CustomerInfo->withdraw_con_pv ?? "null";
            $this->kebajikan_pv = $CustomerInfo->kebajikan_pv ?? "null";
            $this->khairat_pv = $CustomerInfo->khairat_pv ?? "null";
            $this->closed_mbr_pv = $CustomerInfo->closed_mbr_pv ?? "null";
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
