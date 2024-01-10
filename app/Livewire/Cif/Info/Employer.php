<?php

namespace App\Livewire\Cif\Info;

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
use App\Models\Cif\CifCustomer;

use Livewire\Component;

class Employer extends Component
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
        $clientID = auth()->user()->client_id;
        $CustomerInfo = CifCustomer::where('uuid', $this->uuid)->where('client_id', $clientID)->first();
        $MembershipInfo = Membership::where('cif_id', $CustomerInfo->id)->first();

        if ($CustomerInfo) {
            $this->client_id = $CustomerInfo->client_id;
            $this->id = $CustomerInfo->id ;
            $this->uuid = $CustomerInfo->uuid;
            $this->current_employment_date = $CustomerInfo->current_employment_date ?? '';
            $this->current_employer_name = $CustomerInfo->current_employer_name ?? '';
            $this->company_address = $CustomerInfo->company_address ?? '';
            $this->company_phone_no = $CustomerInfo->company_phone_no ?? '';
            $this->job_position = $CustomerInfo->job_position ?? '';
            $this->current_salary = $CustomerInfo->current_salary ?? '';
            $this->company_fax_no = $CustomerInfo->company_fax_no ?? '';

            $job_group = RefJobGroups::select('groups')->where('id',  $CustomerInfo->job_group_id)->first();
            $this->job_group_id = $job_group->groups ?? '';

            $job_status = RefJobStatus::select('description')->where('id',  $CustomerInfo->job_status_id)->first();
            $this->job_status_id = $job_status->description ?? '';

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
        return view('livewire.cif.info.employer');
    }
}
