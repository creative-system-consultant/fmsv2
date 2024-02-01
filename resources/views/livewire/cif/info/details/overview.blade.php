<div>
    <div>
        <x-card title="Membership Overview" >
            <div class="grid grid-cols-1 gap-2 md:grid-cols-3">
                <x-input label="Staff No" placeholder="" wire:model="staff_no" :disabled="true" />
                <x-input label="Membership No." placeholder="" wire:model="ref_no" :disabled="true" />
                <x-input label="Name" placeholder="" wire:model="name" :disabled=$disabled />
                <x-input label="Identity No" placeholder="" wire:model="identity_no" :disabled=$disabled />
                <x-input label="Category" placeholder="" wire:model="cust_status" :disabled="true" />
                <x-input label="Status" placeholder="" wire:model="status_id" :disabled="true" />
                <x-input label="Apply Date" placeholder="" wire:model="apply_date" :disabled="true" />
                <x-input label="Start Date" placeholder="" wire:model="start_date" :disabled="true" />
                <x-input label="Status Change Date" placeholder="" wire:model="status_change_date" :disabled="true" />
                <x-input label="Approved Retirement Date" placeholder="" wire:model="approved_retirement_date" :disabled=$disabled />
                <x-input label="Effective Retirement Date" placeholder="" wire:model="effective_retirement_date" :disabled=$disabled />
                <x-input label="Entrance Fee" placeholder="" wire:model="entrance_fee" :disabled="true" />
                <x-input label="Entrance Fee Date" placeholder="" wire:model="entrance_fee_date" :disabled="true" />
                <x-native-select label="Bank" placeholder="Select Bank" :options="$bankOptions" option-label="name" option-value="id" wire:model="bank_id" :disabled=$disabled />
                <x-input label="Bank Acct No" placeholder="" wire:model="bank_acct_no" :disabled=$disabled />
                <x-native-select label="Payment Type" placeholder="Select Payment Type" :options="$paymentTypeOptions" option-label="name" option-value="id" wire:model="payment_type_id" :disabled=$disabled />
                <x-input label="Staff No (Payer)" placeholder="" wire:model="staffno_payer_id" :disabled=$disabled />
                <x-input label="VA Account" placeholder="" wire:model="va_account" :disabled="true" />
            </div>
        </x-card>
    </div>
</div>
