<div>
    <div class="mt-6">
        <x-card title="Member's Information" >
            <div class="grid grid-cols-1 gap-2 md:grid-cols-4">
                <x-input label="Title" placeholder="" wire:model="title_id" :disabled=$disabled />
                <x-input label="Name" placeholder="" wire:model="name" :disabled=$disabled />
                <x-input label="Identity Type" placeholder="" wire:model="identity_type_id" :disabled=$disabled />
                <x-input label="Identity No" placeholder="" wire:model="identity_no" :disabled=$disabled />
                <x-input label="Primary Email" placeholder="" wire:model="email" :disabled=$disabled />
                <x-input label="Mobile Phone" placeholder="" wire:model="phone" :disabled=$disabled />
                <x-input label="Resident Phone" placeholder="" wire:model="resident_phone" :disabled=$disabled />
                <x-input label="Gender" placeholder="" wire:model="gender_id" :disabled=$disabled />
                <x-input label="Date of Birth" placeholder="" wire:model="birth_date" :disabled=$disabled />
                <x-input label="Race" placeholder="" wire:model="race_id" :disabled=$disabled />
                <x-input label="Religion" placeholder="" wire:model="religion" :disabled=$disabled />
                <x-input label="Education" placeholder="" wire:model="education" :disabled=$disabled />
                <x-input label="Bumiputera Status" placeholder="" wire:model="bumi" :disabled=$disabled />
                <x-input label="Marital" placeholder="" wire:model="marital_id" :disabled=$disabled />
                <x-input label="Citizenship" placeholder="" wire:model="country_id" :disabled=$disabled />
                <x-native-select label="Bank" placeholder="Select Bank" :options="$bankOptions" option-label="name" option-value="id" wire:model="bank_id" :disabled=$disabled />
                <x-input label="Bank Acc No" placeholder="" wire:model="bank_acct_no" :disabled=$disabled />
            </div>
        </x-card>
    </div>
</div>
