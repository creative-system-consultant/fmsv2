<div>
    <div class="mt-6">
        <x-card title="Employer Information" >
            <div class="grid grid-cols-1 gap-2 md:grid-cols-3">
                <x-input label="Company Name" placeholder="" wire:model="current_employer_name" :disabled=$disabled />

                <x-input label="Company Address" placeholder="" wire:model="company_address" :disabled=$disabled />

                <x-input label="Company Phone No" placeholder="" wire:model="company_phone_no" :disabled=$disabled />

                <x-input label="Company Fax No" placeholder="" wire:model="company_fax_no" :disabled=$disabled />

                <x-input label="Job Group ID" placeholder="" wire:model="job_group_id" :disabled=$disabled />

                <x-input label="Job Status ID" placeholder="" wire:model="job_status_id" :disabled=$disabled />

                <x-input label="Job Position" placeholder="" wire:model="job_position" :disabled=$disabled />

                <x-input label="Current Employment Date" placeholder="" wire:model="current_employment_date" :disabled=$disabled />

                <x-input label="Current Salary" placeholder="" wire:model="current_salary" :disabled=$disabled />

            </div>
        </x-card>
    </div>
</div>
