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
</div>

