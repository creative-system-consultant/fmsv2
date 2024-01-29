<div>
    <div>
        <x-card title="Membership Overview" >
            <div class="grid grid-cols-1 gap-2 md:grid-cols-3">
                <x-input label="Staff No" placeholder="" wire:model="staff_no" :disabled=$disabled />
                <x-input label="Membership No." placeholder="" wire:model="ref_no" :disabled=$disabled />
                <x-input label="Name" placeholder="" wire:model="name" :disabled=$disabled />
                <x-input label="Identity No" placeholder="" wire:model="identity_no" :disabled=$disabled />
                <x-input label="Category" placeholder="" wire:model="cust_status" :disabled=$disabled />
                <x-input label="Status" placeholder="" wire:model="status_id" :disabled=$disabled />
                <x-input label="Apply Date" placeholder="" wire:model="apply_date" :disabled=$disabled />
                <x-input label="Start Date" placeholder="" wire:model="start_date" :disabled=$disabled />
                <x-input label="Status Change Date" placeholder="" wire:model="status_change_date" :disabled=$disabled />
                <x-input label="Approved Retirement Date" placeholder="" wire:model="approved_retirement_date" :disabled=$disabled />
                <x-input label="Effective Retirement Date" placeholder="" wire:model="effective_retirement_date" :disabled=$disabled />
                <x-input label="Entrance Fee" placeholder="" wire:model="entrance_fee" :disabled=$disabled />
                <x-input label="Entrance Fee Date" placeholder="" wire:model="entrance_fee_date" :disabled=$disabled />
                <x-input label="Bank ID" placeholder="" wire:model="bank_id" :disabled=$disabled />
                <x-input label="Bank Acct No" placeholder="" wire:model="bank_acct_no" :disabled=$disabled />
                <x-input label="Payment Type" placeholder="" wire:model="payment_type" :disabled=$disabled />
                <x-input label="Staff No (Payer)" placeholder="" wire:model="staffno_payer" :disabled=$disabled />
                <x-input label="VA Account" placeholder="" wire:model="va_account" :disabled=$disabled />
            </div>
        </x-card>
    </div>
</div>
