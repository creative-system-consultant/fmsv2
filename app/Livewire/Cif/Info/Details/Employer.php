<?php

namespace App\Livewire\Cif\Info\Details;

use App\Models\Cif\CifCustomer;
use App\Models\Ref\RefJobGroups;
use App\Models\Ref\RefJobStatus;
use Livewire\Component;

class Employer extends Component
{
    public $uuid, $current_employer_name, $company_address, $company_phone_no, $company_fax_no, $job_group_id, $job_status_id, $job_position, $current_employment_date, $current_salary;

    public function mount()
    {
        $customerInfo = CifCustomer::with('employer')->where('uuid', $this->uuid)->first();
        $job_group = RefJobGroups::select('groups')->where('id',  $customerInfo->job_group_id)->first();
        $job_status = RefJobStatus::select('description')->where('id',  $customerInfo->job_status_id)->first();

        $this->current_employer_name = $customerInfo->employer->name;
        $this->company_address = '';
        $this->company_phone_no = $customerInfo->employer->office_num;
        $this->company_fax_no = '';
        $this->job_group_id = $job_group->groups ?? '';
        $this->job_status_id = $job_status->description ?? '';
        $this->job_position = $customerInfo->employer->position_id;
        $this->current_employment_date = $customerInfo->employer->work_start;
        $this->current_salary = $customerInfo->employer->salary_ref;
    }

    public function render()
    {
        return view('livewire.cif.info.details.employer');
    }
}
