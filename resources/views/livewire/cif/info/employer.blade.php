<div>
    <!-- Employer Information -->
    <div class="mt-6">
        <x-card title="Employer Information" >
            <div class="grid grid-cols-1 gap-2 md:grid-cols-3">
                <x-input label="Name" placeholder="" wire:model="current_employer_name" :disabled=$disabled />
                <x-input label="Address" placeholder="" wire:model="company_address" :disabled=$disabled />
                <x-input label="Phone No" placeholder="" wire:model="company_phone_no" :disabled=$disabled />
                <x-input label="Work Phone No" placeholder="" wire:model="company_fax_no" :disabled=$disabled />
                <x-input label="Department" placeholder="" wire:model="job_department" :disabled=$disabled />
                <x-input label="Position" placeholder="" wire:model="job_position" :disabled=$disabled />
                <x-input label="Start Employment Date" placeholder="" wire:model="current_employment_date" :disabled=$disabled />
                <x-input label="Salary" placeholder="" wire:model="current_salary" :disabled=$disabled />
            </div>
        </x-card>
    </div>
</div>
