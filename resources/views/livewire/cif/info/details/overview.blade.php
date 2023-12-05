<div>
    <div class="mt-6">
        <x-card title="Membership Overview" >
            <x-slot name="action" >
                <div class="flex items-center justify-center space-x-2">
                    <x-button primary label="Close Membership Document" sm />
                    <x-button wire:click="editDetail" icon="pencil" primary label="Edit" sm />
                    <x-button icon="save" primary label="Save" sm/>
                </div>
            </x-slot>
            <div class="grid grid-cols-1 gap-2 md:grid-cols-3">
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
</div>
