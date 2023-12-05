<div>
    <div class="mt-6">
        <x-card title="Member's Information" >
            <div class="grid grid-cols-1 gap-2 md:grid-cols-3">

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
