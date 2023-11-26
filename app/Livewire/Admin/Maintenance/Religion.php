<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefReligion;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Religion extends Component
{
    use Actions, WithPagination, MaintenanceModalTrait;

    // Properties for modal and religion management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $religion;

    // Properties for relationship data
    public $code;
    public $description;

    // Pagination & searching
    public $paginated;
    public $searchQuery;

    // Services
    protected $popupService;

    public function rules()
    {
        return [
            'code' => ['required', 'alpha', 'min:2', 'max:2'],
            'description' => ['required', new ValidDescription],
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Religion", "Religion");
        $this->reset(['description', 'code']); // Clear the values for description and code
        $this->resetValidation(); // Clear validation errors
    }

    public function openUpdateModal($id)
    {
        $this->religion = ModelService::findById(RefReligion::class, $id);
        $this->description = $this->religion->description;
        $this->code = $this->religion->code;
        $this->setupModal("update", "Update Religion", "Religion", "update({$id})");
        $this->resetValidation(); // Clear validation errors
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

        if (MaintenanceService::isCodeExists(RefReligion::class, $formattedData['code'])) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            ModelService::create(RefReligion::class, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefReligion::class, $id, $formattedData['code'])) {
            ModelService::update(RefReligion::class, $id, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id,$code)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you sure you want to delete CODE: ' . $code .'?', $id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefReligion::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefReligion::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
        );

        return view('livewire.admin.maintenance.religion', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
