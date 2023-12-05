<?php

namespace App\Livewire\Cif\Info;

use App\Models\Cif\CifCustomer;
use App\Models\Cif\Employer;
use App\Models\Fms\Membership;
use App\Models\Ref\RefBank;
use App\Models\Ref\RefCountry;
use App\Models\Ref\RefGender;
use App\Models\Ref\RefIdentityType;
use App\Models\Ref\RefJobGroups;
use App\Models\Ref\RefJobStatus;
use App\Models\Ref\RefLanguage;
use App\Models\Ref\RefMarital;
use App\Models\Ref\RefMemStatus;
use App\Models\Ref\RefPaymentType;
use App\Models\Ref\RefRace;
use App\Models\Ref\RefTitle;
use Livewire\Component;

class Details extends Component
{


    public $client_id, $id, $uuid, $title_id, $name, $identity_type_id, $identity_no, $other_identity_type_id, $other_identity_no,
        $gender_id, $birth_date, $race_id, $language_id, $marital_id, $country_id, $income_group_id, $phone, $resident_phone, $email,
        $email2, $fax, $current_employer_name, $current_employment_date, $current_employment_year_service, $entity_type_id, $bnm_customer_type_id,
        $business_activity_code_id, $business_type_id, $franchisor_name, $brand_name, $business_status_id, $business_registration_date, $authorised_capital,
        $paidup_capital, $commencement_date, $muslim_control, $risk_rating, $risk_rating_date, $watchlist_type_id, $review_frequency_id, $watchlist_start_date,
        $watchlist_end_date, $watchlist_remarks, $staff_no, $education_id, $religion_id, $branch_id, $position_id, $data_status, $created_by, $customer_group_id,
        $company_address, $job_position, $updated_by, $deleted_by, $created_at, $updated_at, $deleted_at, $current_salary, $company_phone_no, $company_fax_no,
        $job_group_id, $job_status_id, $department_id, $bank_id, $bank_acct_no, $cust_status, $staffno_payer, $cif_id, $cif_id_work_in_progress, $ref_no,
        $apply_date, $start_date, $end_date, $total_share, $monthly_share, $last_purchase_amount, $last_purchase_date, $last_selling_amount, $last_selling_date,
        $total_contribution, $monthly_contribution, $last_payment_amount, $last_payment_date, $last_withdraw_amount, $last_withdraw_date, $total_withdraw_amount,
        $status_id, $status_change_date, $type_id, $approved_retirement_date, $effective_retirement_date, $retirement_flag, $entrance_fee, $entrance_fee_date,
        $introducer_name, $introducer_mbrid, $introducer_icno, $introducer_flag, $no_of_withdrawal, $source, $tkk_amount, $tkk_last_pay_dt, $va_account,
        $year_tabung_khirat, $amt_tabung_khirat, $payment_type, $withdraw_share_pv, $withdraw_con_pv, $kebajikan_pv, $khairat_pv, $closed_mbr_pv, $bumi;


    public $editDetail = false;

    public function mount()
    {
        $CustomerInfo = CifCustomer::where('uuid', $this->uuid)->first();
        $MembershipInfo = Membership::where('cif_id', $CustomerInfo->id)->first();

        if ($CustomerInfo) {

            // Assuming you have a $CustomerInfo object from your database query

            $this->client_id = $CustomerInfo->client_id;
            $this->id = $CustomerInfo->id ;
            $this->uuid = $CustomerInfo->uuid;
            $title = RefTitle::select('description')->where('id', $CustomerInfo->title_id)->first();
            $this->title_id = $title->description ?? '';

            $this->name = $CustomerInfo->name ?? '';

            $identityType = RefIdentityType::select('description')->where('id', $CustomerInfo->identity_type_id)->first();
            $this->identity_type_id = $identityType->description ?? '';

            $this->identity_no = $CustomerInfo->identity_no ?? '';
            $this->other_identity_type_id = $CustomerInfo->other_identity_type_id ?? '';
            $this->other_identity_no = $CustomerInfo->other_identity_no ?? '';

            $gender = RefGender::select('description')->where('id', $CustomerInfo->gender_id)->first();
            $this->gender_id = $gender->description;

            $this->birth_date = $CustomerInfo->birth_date ?? '';

            $race = RefRace::select('description')->where('id', $CustomerInfo->race_id)->first();
            $this->race_id = $race->description ?? '';

            $this->bumi = (($CustomerInfo->race_id != 6 || $CustomerInfo->race_id != 9 || $CustomerInfo->race_id != 14) ? 'Yes' : 'No');

            $language = RefLanguage::select('description')->where('id', $CustomerInfo->language_id)->first();
            $this->language_id = $language->description ?? '';

            $marital = RefMarital::select('description')->where('id', $CustomerInfo->marital_id)->first();
            $this->marital_id = $marital->description ?? '';

            $country = RefCountry::select('description')->where('id', $CustomerInfo->country_id)->first();
            $this->country_id = $country->description ?? '';

            $this->income_group_id = $CustomerInfo->income_group_id ?? '';
            $this->phone = $CustomerInfo->phone ?? '';
            $this->resident_phone = $CustomerInfo->resident_phone ?? '';
            $this->email = $CustomerInfo->email ?? '';
            $this->email2 = $CustomerInfo->email2 ?? '';
            $this->fax = $CustomerInfo->fax ?? '';
            $this->current_employer_name = $CustomerInfo->current_employer_name ?? '';
            $this->current_employment_date = $CustomerInfo->current_employment_date ?? '';
            $this->current_employment_year_service = $CustomerInfo->current_employment_year_service ?? '';
            $this->entity_type_id = $CustomerInfo->entity_type_id ?? '';
            $this->bnm_customer_type_id = $CustomerInfo->bnm_customer_type_id ?? '';
            $this->business_activity_code_id = $CustomerInfo->business_activity_code_id ?? '';
            $this->business_type_id = $CustomerInfo->business_type_id ?? '';
            $this->franchisor_name = $CustomerInfo->franchisor_name ?? '';
            $this->brand_name = $CustomerInfo->brand_name ?? '';
            $this->business_status_id = $CustomerInfo->business_status_id ?? '';
            $this->business_registration_date = $CustomerInfo->business_registration_date ?? '';
            $this->authorised_capital = $CustomerInfo->authorised_capital ?? '';
            $this->paidup_capital = $CustomerInfo->paidup_capital ?? '';
            $this->commencement_date = $CustomerInfo->commencement_date ?? '';
            $this->muslim_control = $CustomerInfo->muslim_control ?? '';
            $this->risk_rating = $CustomerInfo->risk_rating ?? '';
            $this->risk_rating_date = $CustomerInfo->risk_rating_date ?? '';
            $this->watchlist_type_id = $CustomerInfo->watchlist_type_id ?? '';
            $this->review_frequency_id = $CustomerInfo->review_frequency_id ?? '';
            $this->watchlist_start_date = $CustomerInfo->watchlist_start_date ?? '';
            $this->watchlist_end_date = $CustomerInfo->watchlist_end_date ?? '';
            $this->watchlist_remarks = $CustomerInfo->watchlist_remarks ?? '';
            $this->staff_no = $CustomerInfo->staff_no ?? '';
            $this->education_id = $CustomerInfo->education_id ?? '';
            $this->religion_id = $CustomerInfo->religion_id ?? '';
            $this->branch_id = $CustomerInfo->branch_id ?? '';
            $this->position_id = $CustomerInfo->position_id ?? '';
            $this->data_status = $CustomerInfo->data_status ?? '';
            $this->created_by = $CustomerInfo->created_by ?? '';
            $this->customer_group_id = $CustomerInfo->customer_group_id ?? '';
            $this->company_address = $CustomerInfo->company_address ?? '';
            $this->job_position = $CustomerInfo->job_position ?? '';
            $this->current_salary = $CustomerInfo->current_salary ?? '';
            $this->company_phone_no = $CustomerInfo->company_phone_no ?? '';
            $this->company_fax_no = $CustomerInfo->company_fax_no ?? '';

            $job_group = RefJobGroups::select('groups')->where('id',  $CustomerInfo->job_group_id)->first();
            $this->job_group_id = $job_group->groups ?? '';

            $job_status = RefJobStatus::select('description')->where('id',  $CustomerInfo->job_status_id)->first();
            $this->job_status_id = $job_status->description ?? '';

            $this->department_id = $CustomerInfo->department_id ?? '';

            $bank_name = RefBank::select('description')->where('id',  $CustomerInfo->bank_id)->first();
            $this->bank_id = $bank_name->description ?? '';

            $this->bank_acct_no = $CustomerInfo->bank_acct_no ?? '';
            $this->cust_status = ($CustomerInfo->cust_status == 'Y' ? 'Members' : 'Non Members');
            $this->staffno_payer = $CustomerInfo->staffno_payer ?? '';

            $this->cif_id = $MembershipInfo->cif_id ?? '';
            $this->cif_id_work_in_progress = $MembershipInfo->cif_id_work_in_progress ?? '';
            $this->ref_no = $MembershipInfo->ref_no ?? '';
            $this->apply_date = $MembershipInfo->apply_date ?? '';
            $this->start_date = $MembershipInfo->start_date ?? '';
            $this->end_date = $MembershipInfo->end_date ?? '';
            $this->total_share = $MembershipInfo->total_share ?? '';
            $this->monthly_share = $MembershipInfo->monthly_share ?? '';
            $this->last_purchase_amount = $MembershipInfo->last_purchase_amount ?? '';
            $this->last_purchase_date = $MembershipInfo->last_purchase_date ?? '';
            $this->last_selling_amount = $MembershipInfo->last_selling_amount ?? '';
            $this->last_selling_date = $MembershipInfo->last_selling_date ?? '';
            $this->total_contribution = $MembershipInfo->total_contribution ?? '';
            $this->monthly_contribution = $MembershipInfo->monthly_contribution ?? '';
            $this->last_payment_amount = $MembershipInfo->last_payment_amount ?? '';
            $this->last_payment_date = $MembershipInfo->last_payment_date ?? '';
            $this->last_withdraw_amount = $MembershipInfo->last_withdraw_amount ?? '';
            $this->last_withdraw_date = $MembershipInfo->last_withdraw_date ?? '';
            $this->total_withdraw_amount = $MembershipInfo->total_withdraw_amount ?? '';

            $memberStatus = RefMemStatus::select('description')->where('id', $MembershipInfo->status_id)->first();
            $this->status_id = $memberStatus->description ?? '';

            $this->status_change_date = $MembershipInfo->status_change_date ?? '';
            $this->type_id = $MembershipInfo->type_id ?? '';
            $this->approved_retirement_date = $MembershipInfo->approved_retirement_date ?? '';
            $this->effective_retirement_date = $MembershipInfo->effective_retirement_date ?? '';
            $this->retirement_flag = $MembershipInfo->retirement_flag ?? '';
            $this->entrance_fee = $MembershipInfo->entrance_fee ?? '';
            $this->entrance_fee_date = $MembershipInfo->entrance_fee_date?? '' ;
            $this->introducer_name = $MembershipInfo->introducer_name ?? '';
            $this->introducer_mbrid = $MembershipInfo->introducer_mbrid ?? '';
            $this->introducer_icno = $MembershipInfo->introducer_icno ?? '';
            $this->introducer_flag = $MembershipInfo->introducer_flag ?? '';
            $this->no_of_withdrawal = $MembershipInfo->no_of_withdrawal ?? '';
            $this->source = $MembershipInfo->source ?? '';
            $this->tkk_amount = $MembershipInfo->tkk_amount ?? '';
            $this->tkk_last_pay_dt = $MembershipInfo->tkk_last_pay_dt ?? '';
            $this->va_account = $MembershipInfo->va_account ?? '';
            $this->year_tabung_khirat = $MembershipInfo->year_tabung_khirat ?? '';
            $this->amt_tabung_khirat = $MembershipInfo->amt_tabung_khirat ?? '';

            $paymentType = RefPaymentType::select('description')->where('id', $MembershipInfo->payment_type)->first();
            $this->payment_type = $paymentType->description ?? '';

            $this->withdraw_share_pv = $MembershipInfo->withdraw_share_pv ?? '';
            $this->withdraw_con_pv = $MembershipInfo->withdraw_con_pv ?? '';
            $this->kebajikan_pv = $MembershipInfo->kebajikan_pv ?? '';
            $this->khairat_pv = $MembershipInfo->khairat_pv ?? '';
            $this->closed_mbr_pv = $MembershipInfo->closed_mbr_pv ?? '';
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
        return view('livewire.cif.info.details')->extends('layouts.main');
    }
}
