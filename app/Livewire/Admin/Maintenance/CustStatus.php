<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefCustStatus;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class CustStatus extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and cust status management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $custStatus;

    // Properties for cust status data
    public $description;

    // Pagination & searching
    public $paginated;
    public $searchQuery;

    // Services
    protected $popupService;

    public function rules()
    {
        return [
            'description' => ['required', new ValidDescription, 'max:50'],
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Customer Status", "Description");
        $this->reset('description');
        $this->resetValidation();
    }

    public function openUpdateModal($description)
    {
        $this->custStatus = ModelService::findById(RefCustStatus::class, $description);
        $this->description = $this->custStatus->description;
        $this->setupModal("update", "Update Customer Status", "Description", "update({$description})");
        $this->resetValidation();
    }

    protected function formatData()
    {
        return [
            'description' => FormattingService::formatDescription($this->description),
        ];
    }

    public function create()
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefCustStatus::class, $formattedData['description'], 'description')) {
            $this->addError('description', 'The status has already been taken.');
        } else {
            ModelService::create(RefCustStatus::class, $formattedData);
            $this->reset('description');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefCustStatus::class, $id, $formattedData['description'], 'description')) {
            ModelService::update(RefCustStatus::class, $id, $formattedData);
            $this->reset('description');
            $this->openModal = false;
        } else {
            $this->addError('description', 'The status has already been taken.');
        }
    }

    public function delete($id, $description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', "Are you sure to delete status: " . $description . "?",$id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefCustStatus::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefCustStatus::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
            [
                'description' => 'ASC'
            ]
        );

        return view('livewire.admin.maintenance.cust-status',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}