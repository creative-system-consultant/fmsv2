<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefMemStatus;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class MemberStatus extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and member status management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $mbrstatus;

    // Properties for member status data
    public $mbr_status;
    public $description;

    // Pagination and searching
    public $paginated;
    public $searchQuery;

    // Services
    protected $popupService;

    public function rules()
    {
        return [
            'mbr_status' => ['required', 'alpha', 'max:1'],
            'description' => ['required', new ValidDescription],
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Member Status", "Description");
        $this->reset(['mbr_status','description']);
        $this->resetValidation();
    }

    public function openUpdateModal($id)
    {
        $this->mbrstatus = ModelService::findById(RefMemStatus::class, $id);
        $this->mbr_status = $this->mbrstatus->mbr_status;
        $this->description = $this->mbrstatus->description;
        $this->setupModal("update", "Update Member Status", "Description", "update({$id})");
        $this->resetValidation();
    }

    protected function formatData()
    {
        return [
            'mbr_status' => FormattingService::formatCode($this->mbr_status),
            'description' => FormattingService::formatDescription($this->description),
        ];
    }

    public function create()
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefMemStatus::class, $formattedData['mbr_status'], 'mbr_status')) {
            $this->addError('mbr_status', 'The code has already been taken.');
        } else {
            ModelService::create(RefMemStatus::class, $formattedData);
            $this->reset('mbr_status', 'description');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefMemStatus::class, $id, $formattedData['mbr_status'], 'mbr_status')) {
            ModelService::update(RefMemStatus::class, $id, $formattedData);
            $this->reset('mbr_status', 'description');
            $this->openModal = false;
        } else {
            $this->addError('mbr_status', 'The code has already been taken.');
        }
    }

    public function delete($id, $mbr_status, $description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', "Are you sure to delete code STATUS " . $mbr_status . " : " .$description. "?",$id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefMemStatus::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefMemStatus::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
        );

        return view('livewire.admin.maintenance.member-status',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}
