<div>
    <div class="mt-6">
        <x-card title="Member's Information" >
            <div class="grid grid-cols-1 gap-2 md:grid-cols-3">
                <x-input label="Title ID" placeholder="" wire:model="title_id" :disabled=$disabled />
                <x-input label="Name" placeholder="" wire:model="name" :disabled=$disabled />
                <x-input label="Identity Type ID" placeholder="" wire:model="identity_type_id" :disabled=$disabled />
                <x-input label="Identity No" placeholder="" wire:model="identity_no" :disabled=$disabled />
                <x-input label="Email" placeholder="" wire:model="email" :disabled=$disabled />
                <x-input label="Secondary Email" placeholder="" wire:model="email2" :disabled=$disabled />
                <x-input label="Phone" placeholder="" wire:model="phone" :disabled=$disabled />
                <x-input label="Resident Phone" placeholder="" wire:model="resident_phone" :disabled=$disabled />
                <x-input label="Gender" placeholder="" wire:model="gender_id" :disabled=$disabled />
                <x-input label="Birth Date" placeholder="" wire:model="birth_date" :disabled=$disabled />
                <x-input label="Race" placeholder="" wire:model="race_id" :disabled=$disabled />
                <x-input label="Bumiputra Status" placeholder="" wire:model="bumi" :disabled=$disabled />
                <x-input label="Marital ID" placeholder="" wire:model="marital_id" :disabled=$disabled />
                <x-input label="Country ID" placeholder="" wire:model="country_id" :disabled=$disabled />
                <x-input label="Monthly Contribution" placeholder="" wire:model="monthly_contribution" :disabled=$disabled />
                <x-input label="Year Tabung Khairat" placeholder="" wire:model="year_tabung_khairat" :disabled=$disabled />
                <x-input label="Tabung khairat" placeholder="" wire:model="amt_tabung_khairat" :disabled=$disabled />

            </div>
        </x-card>
    </div>
</div>
