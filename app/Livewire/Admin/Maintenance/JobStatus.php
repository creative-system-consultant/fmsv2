<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefJobStatus;
use App\Services\General\PopupService;
use App\Services\Model\JobStatusService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class JobStatus extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|alpha|max:2')]
    public $code;

    #[Rule('required|regex:/^[A-Za-z\s]*$/|max:50')]
    public $description;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $jobstatus;
    public $paginated;
    public $searchQuery;

    protected $jobstatus_Service;
    protected $popupService;

    public function __construct()
    {
        $this->jobstatus_Service = new JobStatusService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Job Status", "Description");
        $this->reset(['code','description']);
        $this->resetValidation();
    }

    public function openUpdateModal($id)
    {
        $this->jobstatus = RefJobStatus::find($id);
        $this->code = $this->jobstatus->code;
        $this->description = $this->jobstatus->description;
        $this->setupModal("update", "Update Job Status", "Description", "update({$id})");
        $this->resetValidation();
    }

    public function create()
    {

        $this->validate();

        $trim_code = trim($this->code);
        
        if (JobStatusService::isCodeExists($trim_code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $data = [
                'code' => strtoupper($trim_code),
                'description'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
            ];
            JobStatusService::createJobStatus($data);
            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $trim_code = trim($this->code);

        if (JobStatusService::canUpdateCode($id,  $trim_code)) {
    
            $data = [
                'code' => strtoupper($trim_code),
                'description'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->description)))
            ];
            JobStatusService::updateJobStatus($id, $data);
            $this->openModal = false;

        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id, $code, $description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 
        "Are you sure to delete CODE " . $code . " : " .$description. " ?",$id);
    }

    public function ConfirmDelete($id)
    {
        JobStatusService::deleteJobStatus($id);
    }

    public function render()
    {
        $data = $this->jobstatus_Service->getJobStatusResult($this->searchQuery, $this->paginated);
        return view('livewire.admin.maintenance.job-status', [
            'data' => $data
            ])->extends('layouts.main');
    }

}