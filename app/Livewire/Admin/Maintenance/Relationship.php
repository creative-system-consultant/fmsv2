<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefRelationship;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Relationship extends Component
{
    use Actions, WithPagination, MaintenanceModalTrait;

    // Properties for modal and relationship management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $relationship;

    // Properties for relationship data
    public $code;
    public $description;

    // Pagination
    public $paginated;

    // Services
    protected $relationshipService;
    protected $popupService;

    public function rules()
    {
        return [
            'code' => ['required', 'numeric', 'min:1', 'max:99'],
            'description' => ['required', new ValidDescription],
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Relationship", "Relationship");
    }

    public function openUpdateModal($id)
    {
        $this->relationship = ModelService::findById(RefRelationship::class, $id);
        $this->description = $this->relationship->description;
        $this->code = $this->relationship->code;
        $this->setupModal("update", "Update Relationship", "Relationship", "update({$id})");
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

        if (MaintenanceService::isCodeExists(RefRelationship::class, $formattedData['code'])) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            ModelService::create(RefRelationship::class, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefRelationship::class, $id, $formattedData['code'])) {
            ModelService::update(RefRelationship::class, $id, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you delete the information?',$id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefRelationship::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefRelationship::class,
            $this->paginated, // $perPage
        );

        return view('livewire.admin.maintenance.relationship', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
