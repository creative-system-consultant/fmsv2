<div>

    <!-- Employer Information -->
    <div class="mt-6">
        <x-card title="Employer Information" >
            <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
                <x-input label="Company Name" placeholder="" wire:model="current_employer_name" :disabled="true" />

                <x-input label="Company Address" placeholder="" wire:model="company_address" :disabled="true" />

                <x-input label="Company Phone No" placeholder="" wire:model="company_phone_no" :disabled="true" />

                <x-input label="Company Fax No" placeholder="" wire:model="company_fax_no" :disabled="true" />

                <x-input label="Job Group ID" placeholder="" wire:model="job_group_id" :disabled="true" />

                <x-input label="Job Status ID" placeholder="" wire:model="job_status_id" :disabled="true" />

                <x-input label="Job Position" placeholder="" wire:model="job_position" :disabled="true" />

                <x-input label="Current Employment Date" placeholder="" wire:model="current_employment_date" :disabled="true" />

                <x-input label="Current Salary" placeholder="" wire:model="current_salary" :disabled="true" />
            </div>
        </x-card>
    </div>
</div>

