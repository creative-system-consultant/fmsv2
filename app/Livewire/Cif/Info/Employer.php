<?php

namespace App\Livewire\Cif\Info;

use App\Models\Fms\Membership;
use App\Models\Ref\RefJobGroups;
use App\Models\Ref\RefJobStatus;
use App\Models\Cif\CifCustomer;
use Carbon\Carbon;
use Livewire\Component;

class Employer extends Component
{
    public $disabled = true;
    public $uuid, $current_employer_name, $company_address, $company_phone_no, $company_fax_no, $job_group_id, $job_department, $job_position, $work_status, $current_employment_date, $current_salary, $clientID;

    public function mount()
    {
        $clientID = auth()->user()->client_id;
        $customerInfo = CifCustomer::with('employer', 'employer.address')->where('uuid', $this->uuid)->where('client_id', $clientID)->first();
        $job_group = RefJobGroups::select('groups')->where('id',  $customerInfo->job_group_id)->first();
        $job_status = RefJobStatus::select('description')->where('id',  $customerInfo->employer->job_status_id)->first();

        $this->current_employer_name = ($customerInfo->employer) ? $customerInfo->employer->name : '';
        $this->company_address = $customerInfo->employer->fullAddress ?? '';
        $this->company_phone_no = ($customerInfo->employer) ? $customerInfo->employer->office_num : '';
        $this->company_fax_no = ($customerInfo->employer) ? $customerInfo->employer->worker_num : '';
        $this->job_group_id = $job_group->groups ?? '';
        $this->work_status = $job_status->description ?? '';
        $this->job_department = ($customerInfo->employer) ? $customerInfo->employer->department : '';
        $this->job_position = ($customerInfo->employer) ? $customerInfo->employer->position : '';
        $this->current_employment_date = ($customerInfo->employer) ? Carbon::parse($customerInfo->employer->work_start)->format('d-m-Y') : '';
        $this->current_salary = ($customerInfo->employer) ? $customerInfo->employer->salary : '';
    }

    public function render()
    {
        return view('livewire.cif.info.employer');
    }
}
