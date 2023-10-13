<div>

    <!-- Membership Overview -->
    <div class="mt-6">
        <x-card title="Membership Overview" >
            <x-slot name="action" >
                <div class="flex items-center justify-center space-x-2">
                    <x-button primary label="Close Membership Document" sm />
                    <x-button wire:click="editDetail" icon="pencil" primary label="Edit" sm />
                    <x-button icon="save" primary label="Save" sm/>
                </div>
            </x-slot>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <x-input label="Staff No" placeholder="" wire:model="staff_no" :disabled="true" />

                <x-input label="Membership No." placeholder="" wire:model="ref_no" :disabled="true" />

                <x-input label="Name" placeholder="" wire:model="name" :disabled="true" />

                <x-input label="Identity No" placeholder="" wire:model="identity_no" :disabled="true" />

                <x-input label="Category" placeholder="" wire:model="cust_status" :disabled="true" />

                <x-input label="Status" placeholder="" wire:model="status_id" :disabled="true" />

                <x-input label="Apply Date" placeholder="" wire:model="apply_date" :disabled="true" />

                <x-input label="Start Date" placeholder="" wire:model="start_date" :disabled="true" />

                <x-input label="Status Change Date" placeholder="" wire:model="status_change_date" :disabled="true" />

                <x-input label="Approved Retirement Date" placeholder="" wire:model="approved_retirement_date" :disabled="true" />

                <x-input label="Effective Retirement Date" placeholder="" wire:model="effective_retirement_date" :disabled="true" />

                <x-input label="Entrance Fee" placeholder="" wire:model="entrance_fee" :disabled="true" />

                <x-input label="Entrance Fee Date" placeholder="" wire:model="entrance_fee_date" :disabled="true" />

                <x-input label="Introducer Name" placeholder="" wire:model="introducer_name" :disabled="true" />

                <x-input label="Introducer MBRID" placeholder="" wire:model="introducer_mbrid" :disabled="true" />

                <x-input label="Introducer IC No" placeholder="" wire:model="introducer_icno" :disabled="true" />

                <x-input label="Bank ID" placeholder="" wire:model="bank_id" :disabled="true" />

                <x-input label="Bank Acct No" placeholder="" wire:model="bank_acct_no" :disabled="true" />

                <x-input label="Payment Type" placeholder="" wire:model="payment_type" :disabled="true" />

                <x-input label="Staff No (Payer)" placeholder="" wire:model="staffno_payer" :disabled="true" />

                <x-input label="VA Account" placeholder="" wire:model="va_account" :disabled="true" />
     
            </div>
            
        </x-card>
    </div>

    <!-- Member's Information -->
    <div class="mt-6">
        <x-card title="Member's Information" >
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">

                <x-input label="Title ID" placeholder="" wire:model="title_id" :disabled="true" />

                <x-input label="Name" placeholder="" wire:model="name" :disabled="true" />

                <x-input label="Identity Type ID" placeholder="" wire:model="identity_type_id" :disabled="true" />

                <x-input label="Identity No" placeholder="" wire:model="identity_no" :disabled="true" />

                <x-input label="Email" placeholder="" wire:model="email" :disabled="true" />

                <x-input label="Secondary Email" placeholder="" wire:model="email2" :disabled="true" />

                <x-input label="Phone" placeholder="" wire:model="phone" :disabled="true" />

                <x-input label="Resident Phone" placeholder="" wire:model="resident_phone" :disabled="true" />

                <x-input label="Gender" placeholder="" wire:model="gender_id" :disabled="true" />

                <x-input label="Birth Date" placeholder="" wire:model="birth_date" :disabled="true" />

                <x-input label="Race" placeholder="" wire:model="race_id" :disabled="true" />

                <x-input label="Bumiputra Status" placeholder="" wire:model="bumi" :disabled="true" />

                <x-input label="Language ID" placeholder="" wire:model="language_id" :disabled="true" />

                <x-input label="Marital ID" placeholder="" wire:model="marital_id" :disabled="true" />

                <x-input label="Country ID" placeholder="" wire:model="country_id" :disabled="true" />

                <x-input label="Monthly Contribution" placeholder="" wire:model="monthly_contribution" :disabled="true" />

                <x-input label="Year Tabung Khirat" placeholder="" wire:model="year_tabung_khirat" :disabled="true" />

                <x-input label="Tabung Khirat" placeholder="" wire:model="amt_tabung_khirat" :disabled="true" />
                
            </div>
        </x-card>
    </div>

    <!-- Employer Information -->
    <div class="mt-6">
        <x-card title="Employer Information" >
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <x-input label="Company Name" placeholder="" wire:model="current_employer_name" :disabled="true" />

                <x-input label="Company Address" placeholder="" wire:model="company_address" :disabled="true" />

                <x-input label="Company Phone No" placeholder="" wire:model="company_phone_no" :disabled="true" />

                <x-input label="Company Fax No" placeholder="" wire:model="company_fax_no" :disabled="true" />

                <x-input label="Job Group ID" placeholder="" wire:model="job_group_id" :disabled="true" />

                <x-input label="Job Status ID" placeholder="" wire:model="job_status_id" :disabled="true" />

                <x-input label="Job Position" placeholder="" wire:model="job_position" :disabled="true" />

                <x-input label="Current Employment Date" placeholder="" wire:model="current_employment_date" :disabled="true" />

                <x-input label="Current Salary" placeholder="" wire:model="current_salary" :disabled="true" />




{{-- 
                <x-input label="Client ID" placeholder="" wire:model="client_id" :disabled="true" />
                <x-input label="ID" placeholder="" wire:model="id" :disabled="true" />
                <x-input label="UUID" placeholder="" wire:model="uuid" :disabled="true" />
                <x-input label="Other Identity Type ID" placeholder="" wire:model="other_identity_type_id" :disabled="true" />
                <x-input label="Other Identity No" placeholder="" wire:model="other_identity_no" :disabled="true" />
                
                <x-input label="Income Group ID" placeholder="" wire:model="income_group_id" :disabled="true" />
               
                
                <x-input label="Fax" placeholder="" wire:model="fax" :disabled="true" />
                <x-input label="Current Employment Year Service" placeholder="" wire:model="current_employent_year_service" :disabled="true" />
                <x-input label="Entity Type ID" placeholder="" wire:model="entity_type_id" :disabled="true" />
                <x-input label="BNM Customer Type ID" placeholder="" wire:model="bnm_customer_type_id" :disabled="true" />
                <x-input label="Business Activity Code ID" placeholder="" wire:model="business_activity_code_id" :disabled="true" />
                <x-input label="Business Type ID" placeholder="" wire:model="business_type_id" :disabled="true" />
                <x-input label="Franchisor Name" placeholder="" wire:model="franchisor_name" :disabled="true" />
                <x-input label="Brand Name" placeholder="" wire:model="brand_name" :disabled="true" />
                <x-input label="Business Status ID" placeholder="" wire:model="business_status_id" :disabled="true" />
                <x-input label="Business Registration Date" placeholder="" wire:model="business_registration_date" :disabled="true" />
                <x-input label="Authorised Capital" placeholder="" wire:model="authorised_capital" :disabled="true" />
                <x-input label="Paid-Up Capital" placeholder="" wire:model="paidup_capital" :disabled="true" />
                <x-input label="Commencement Date" placeholder="" wire:model="commencement_date" :disabled="true" />
                <x-input label="Muslim Control" placeholder="" wire:model="muslim_control" :disabled="true" />
                <x-input label="Risk Rating" placeholder="" wire:model="risk_rating" :disabled="true" />
                <x-input label="Risk Rating Date" placeholder="" wire:model="risk_rating_date" :disabled="true" />
                <x-input label="Watchlist Type ID" placeholder="" wire:model="watchlist_type_id" :disabled="true" />
                <x-input label="Review Frequency ID" placeholder="" wire:model="review_frequency_id" :disabled="true" />
                <x-input label="Watchlist Start Date" placeholder="" wire:model="watchlist_start_date" :disabled="true" />
                <x-input label="Watchlist End Date" placeholder="" wire:model="watchlist_end_date" :disabled="true" />
                <x-input label="Watchlist Remarks" placeholder="" wire:model="watchlist_remarks" :disabled="true" />
                <x-input label="Education ID" placeholder="" wire:model="education_id" :disabled="true" />
                <x-input label="Religion ID" placeholder="" wire:model="religion_id" :disabled="true" />
                <x-input label="Branch ID" placeholder="" wire:model="branch_id" :disabled="true" />
                <x-input label="Position ID" placeholder="" wire:model="position_id" :disabled="true" />
                <x-input label="Data Status" placeholder="" wire:model="data_status" :disabled="true" />
                <x-input label="Created By" placeholder="" wire:model="created_by" :disabled="true" />
                <x-input label="Customer Group ID" placeholder="" wire:model="customer_group_id" :disabled="true" />
                
                
                <x-input label="Department ID" placeholder="" wire:model="department_id" :disabled="true" />
                <x-input label="CIF ID" placeholder="" wire:model="cif_id" :disabled="true" />
                <x-input label="CIF ID (Work in Progress)" placeholder="" wire:model="cif_id_work_in_progress" :disabled="true" />
                
                <x-input label="End Date" placeholder="" wire:model="end_date" :disabled="true" />
                <x-input label="Total Share" placeholder="" wire:model="total_share" :disabled="true" />
                <x-input label="Monthly Share" placeholder="" wire:model="monthly_share" :disabled="true" />
                <x-input label="Last Purchase Amount" placeholder="" wire:model="last_purchase_amount" :disabled="true" />
                <x-input label="Last Purchase Date" placeholder="" wire:model="last_purchase_date" :disabled="true" />
                <x-input label="Last Selling Amount" placeholder="" wire:model="last_selling_amount" :disabled="true" />
                <x-input label="Last Selling Date" placeholder="" wire:model="last_selling_date" :disabled="true" />
                <x-input label="Total Contribution" placeholder="" wire:model="total_contribution" :disabled="true" />
                <x-input label="Last Payment Amount" placeholder="" wire:model="last_payment_amount" :disabled="true" />
                <x-input label="Last Payment Date" placeholder="" wire:model="last_payment_date" :disabled="true" />
                <x-input label="Last Withdraw Amount" placeholder="" wire:model="last_withdraw_amount" :disabled="true" />
                <x-input label="Last Withdraw Date" placeholder="" wire:model="last_withdraw_date" :disabled="true" />
                <x-input label="Total Withdraw Amount" placeholder="" wire:model="total_withdraw_amount" :disabled="true" />
                <x-input label="Staff No" placeholder="" wire:model="staff_no" :disabled="true" />
                <x-input label="Branch ID" placeholder="" wire:model="branch_id" :disabled="true" />
                <x-input label="Type ID" placeholder="" wire:model="type_id" :disabled="true" />
                <x-input label="Data Status" placeholder="" wire:model="data_status" :disabled="true" />
                
                <x-input label="Retirement Flag" placeholder="" wire:model="retirement_flag" :disabled="true" />
                
                
                <x-input label="Introducer Flag" placeholder="" wire:model="introducer_flag" :disabled="true" />
                <x-input label="Number of Withdrawals" placeholder="" wire:model="no_of_withdrawal" :disabled="true" />
                <x-input label="Source" placeholder="" wire:model="source" :disabled="true" />
                <x-input label="TKK Amount" placeholder="" wire:model="tkk_amount" :disabled="true" />
                <x-input label="TKK Last Payment Date" placeholder="" wire:model="tkk_last_pay_dt" :disabled="true" />
                
                <x-input label="Withdraw Share PV" placeholder="" wire:model="withdraw_share_pv" :disabled="true" />
                <x-input label="Withdraw Con PV" placeholder="" wire:model="withdraw_con_pv" :disabled="true" />
                <x-input label="Kebajikan PV" placeholder="" wire:model="kebajikan_pv" :disabled="true" />
                <x-input label="Khairat PV" placeholder="" wire:model="khairat_pv" :disabled="true" />
                <x-input label="Closed Member PV" placeholder="" wire:model="closed_mbr_pv" :disabled="true" /> --}}
            </div>
        </x-card>
    </div>
</div>

