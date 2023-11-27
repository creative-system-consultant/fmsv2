<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefJobStatus;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class JobStatus extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and job status management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $jobstatus;

    // Properties for job status data
    public $code;
    public $description;

    // Pagination and searching
    public $paginated;
    public $searchQuery;

    // Services
    protected $popupService;

    public function rules()
    {
        return [
            'code' => 'required|alpha|max:2',
            'description' => ['required', new ValidDescription, 'max:50'],
        ];
    }

    public function __construct()
    {
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
        $this->jobstatus = ModelService::findById(RefJobStatus::class, $id);
        $this->code = $this->jobstatus->code;
        $this->description = $this->jobstatus->description;
        $this->setupModal("update", "Update Job Status", "Description", "update({$id})");
        $this->resetValidation();
    }

    protected function formatData()
    {
        return [
            'code' => FormattingService::formatCode($this->code),
            'description' => FormattingService::formatDescription($this->description),
        ];
    }

    public function create()
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefJobStatus::class, $formattedData['code'])) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            ModelService::create(RefJobStatus::class, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefJobStatus::class, $id, $formattedData['code'])) {
            ModelService::update(RefJobStatus::class, $id, $formattedData);
            $this->reset('code', 'description');
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
        ModelService::delete(RefJobStatus::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefJobStatus::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
            [
                'code' => 'ASC',
                'description' => 'ASC'
            ] // $orderByArray
        );

        return view('livewire.admin.maintenance.job-status', [
            'data' => $data
            ])->extends('layouts.main');
    }

}