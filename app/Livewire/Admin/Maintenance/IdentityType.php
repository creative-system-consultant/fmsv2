<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefIdentityType;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class IdentityType extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and identity type management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $identitytype;

    // Properties for identity type data
    public $type;
    public $description;

    // Pagination & searching
    public $paginated;
    public $searchQuery;

    // Services
    protected $popupService;

    public function rules()
    {
        return [
            'type' => ['required', 'string', 'size:3'],
            'description' => ['required', new ValidDescription],
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Identity Type", "Identity Type");
        $this->reset(['description', 'type']); // Clear the values for description and code
        $this->resetValidation(); // Clear validation errors
    }

    public function openUpdateModal($id)
    {
        $this->identitytype = ModelService::findById(RefIdentityType::class, $id);
        $this->description = $this->identitytype->description;
        $this->type = $this->identitytype->type;
        $this->setupModal("update", "Update Identity Type", "Identity Type", "update({$id})");
        $this->resetValidation(); // Clear validation errors
    }

    protected function formatData()
    {
        return [
            'type' => FormattingService::formatCode($this->type, true, 3),
            'description' => FormattingService::formatDescription($this->description),
        ];
    }

    public function create()
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefIdentityType::class, $formattedData['type'], 'type')) {
            $this->addError('type', 'The type has already been taken.');
        } else {
            ModelService::create(RefIdentityType::class, $formattedData);
            $this->reset('type', 'description');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefIdentityType::class, $id, $formattedData['type'], 'type')) {
            ModelService::update(RefIdentityType::class, $id, $formattedData);
            $this->reset('type', 'description');
            $this->openModal = false;
        } else {
            $this->addError('type', 'The type has already been taken.');
        }
    }

    public function delete($id,$type)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', "Are you sure you want to delete TYPE: ".$type."?", $id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefIdentityType::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefIdentityType::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
        );

        return view('livewire.admin.maintenance.identity-type', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
