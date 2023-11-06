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
                <x-input label="Client ID" placeholder="" wire:model="client_id" :disabled="true" />
                <x-input label="ID" placeholder="" wire:model="id" :disabled="true" />
                <x-input label="UUID" placeholder="" wire:model="uuid" :disabled="true" />
                <x-input label="Ref No" placeholder="" wire:model="ref_no" :disabled="true" />
                <x-input label="Apply Date" placeholder="" wire:model="apply_date" :disabled="true" />
                <x-input label="Start Date" placeholder="" wire:model="start_date" :disabled="true" />
                <x-input label="End Date" placeholder="" wire:model="end_date" :disabled="true" />
                <x-input label="Total Share" placeholder="" wire:model="total_share" :disabled="true" />
                <x-input label="Monthly Share" placeholder="" wire:model="monthly_share" :disabled="true" />
                <x-input label="Last Purchase Amount" placeholder="" wire:model="last_purchase_amount" :disabled="true" />
                <x-input label="Last Purchase Date" placeholder="" wire:model="last_purchase_date" :disabled="true" />
                <x-input label="Last Selling Amount" placeholder="" wire:model="last_selling_amount" :disabled="true" />
                <x-input label="Last Selling Date" placeholder="" wire:model="last_selling_date" :disabled="true" />
                <x-input label="Total Contribution" placeholder="" wire:model="total_contribution" :disabled="true" />
                <x-input label="Monthly Contribution" placeholder="" wire:model="monthly_contribution" :disabled="true" />
                <x-input label="Last Payment Amount" placeholder="" wire:model="last_payment_amount" :disabled="true" />
                <x-input label="Last Payment Date" placeholder="" wire:model="last_payment_date" :disabled="true" />
                <x-input label="Last Withdraw Amount" placeholder="" wire:model="last_withdraw_amount" :disabled="true" />
                <x-input label="Last Withdraw Date" placeholder="" wire:model="last_withdraw_date" :disabled="true" />
                <x-input label="Total Withdraw Amount" placeholder="" wire:model="total_withdraw_amount" :disabled="true" />
                <x-input label="Staff No" placeholder="" wire:model="staff_no" :disabled="true" />
                <x-input label="Status ID" placeholder="" wire:model="status_id" :disabled="true" />
                <x-input label="Status Change Date" placeholder="" wire:model="status_change_date" :disabled="true" />
                <x-input label="Type ID" placeholder="" wire:model="type_id" :disabled="true" />
                <x-input label="Data Status" placeholder="" wire:model="data_status" :disabled="true" />
                <x-input label="Created By" placeholder="" wire:model="created_by" :disabled="true" />
                <x-input label="Updated By" placeholder="" wire:model="updated_by" :disabled="true" />
                <x-input label="Deleted By" placeholder="" wire:model="deleted_by" :disabled="true" />
                <x-input label="Created At" placeholder="" wire:model="created_at" :disabled="true" />
                <x-input label="Updated At" placeholder="" wire:model="updated_at" :disabled="true" />
                <x-input label="Deleted At" placeholder="" wire:model="deleted_at" :disabled="true" />
                <x-input label="Approved Retirement Date" placeholder="" wire:model="approved_retirement_date" :disabled="true" />
                <x-input label="Effective Retirement Date" placeholder="" wire:model="effective_retirement_date" :disabled="true" />
                <x-input label="Retirement Flag" placeholder="" wire:model="retirement_flag" :disabled="true" />
                <x-input label="Entrance Fee" placeholder="" wire:model="entrance_fee" :disabled="true" />
                <x-input label="Entrance Fee Date" placeholder="" wire:model="entrance_fee_date" :disabled="true" />
                <x-input label="Introducer Name" placeholder="" wire:model="introducer_name" :disabled="true" />
                <x-input label="Introducer MBRID" placeholder="" wire:model="introducer_mbrid" :disabled="true" />
                <x-input label="Introducer IC No" placeholder="" wire:model="introducer_icno" :disabled="true" />
                <x-input label="Introducer Flag" placeholder="" wire:model="introducer_flag" :disabled="true" />
                <x-input label="No of Withdrawal" placeholder="" wire:model="no_of_withdrawal" :disabled="true" />
                <x-input label="Source" placeholder="" wire:model="source" :disabled="true" />
                <x-input label="TKK Amount" placeholder="" wire:model="tkk_amount" :disabled="true" />
                <x-input label="TKK Last Pay Date" placeholder="" wire:model="tkk_last_pay_dt" :disabled="true" />
                <x-input label="VA Account" placeholder="" wire:model="va_account" :disabled="true" />
                <x-input label="Year Tabung Khirat" placeholder="" wire:model="year_tabung_khirat" :disabled="true" />
                <x-input label="Amount Tabung Khirat" placeholder="" wire:model="amt_tabung_khirat" :disabled="true" />
                <x-input label="Payment Type" placeholder="" wire:model="payment_type" :disabled="true" />
                <x-input label="Staff No Payer" placeholder="" wire:model="staffno_payer" :disabled="true" />
                <x-input label="Withdraw Share PV" placeholder="" wire:model="withdraw_share_pv" :disabled="true" />
                <x-input label="Withdraw Con PV" placeholder="" wire:model="withdraw_con_pv" :disabled="true" />
                <x-input label="Kebajikan PV" placeholder="" wire:model="kebajikan_pv" :disabled="true" />
                <x-input label="Khairat PV" placeholder="" wire:model="khairat_pv" :disabled="true" />
                <x-input label="Closed MBR PV" placeholder="" wire:model="closed_mbr_pv" :disabled="true" />
                
            </div>
            
        </x-card>
    </div>


</div>

