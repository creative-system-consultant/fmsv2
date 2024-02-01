<?php

namespace App\Livewire\Cif\Info\Details;

use App\Livewire\Cif\Info\Details;
use App\Models\Cif\CifCustomer;
use App\Models\Ref\RefJobGroups;
use App\Models\Ref\RefJobStatus;
use Livewire\Attributes\On;
use Livewire\Component;

class Employer extends Component
{
    public $disabled = true;
    public $uuid, $current_employer_name, $company_address, $company_phone_no, $company_fax_no, $job_group_id, $job_status_id, $job_position, $current_employment_date, $current_salary, $clientID;

    public function mount()
    {
        $clientID = auth()->user()->client_id;
        $customerInfo = CifCustomer::with('employer', 'employer.address')->where('uuid', $this->uuid)->where('client_id', $clientID)->first();
        $job_group = RefJobGroups::select('groups')->where('id',  $customerInfo->job_group_id)->first();
        $job_status = RefJobStatus::select('description')->where('id',  $customerInfo->job_status_id)->first();

        $this->current_employer_name = ($customerInfo->employer) ? $customerInfo->employer->name : '';
        $this->company_address = $customerInfo->employer->fullAddress ?? '';
        $this->company_phone_no = ($customerInfo->employer) ? $customerInfo->employer->office_num : '';
        $this->company_fax_no = $customerInfo->employer->faxNo ?? '';
        $this->job_group_id = $job_group->groups ?? '';
        $this->job_status_id = $job_status->description ?? '';
        $this->job_position = ($customerInfo->employer) ? $customerInfo->employer->position_id : '';
        $this->current_employment_date = ($customerInfo->employer) ? $customerInfo->employer->work_start : '';
        $this->current_salary = ($customerInfo->employer) ? $customerInfo->employer->salary_ref : '';
    }

    #[On('edit')]
    public function editData()
    {
        // $this->disabled = false;
    }

    #[On('save')]
    public function saveData()
    {
        $this->disabled = true;
        $this->dispatch('doneSave')->to(Details::class);
    }

    public function render()
    {
        return view('livewire.cif.info.details.employer');
    }
}
