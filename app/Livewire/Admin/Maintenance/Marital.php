<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefMarital;
use Livewire\Component;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Marital extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and religion management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $marital;

    // Properties for marital data
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
        $this->setupModal("create", "Create Marital", "Marital");
        $this->reset(['description', 'code']); // Clear the values for description and code
        $this->resetValidation(); // Clear validation errors
    }

    public function openUpdateModal($id)
    {
        $this->marital = ModelService::findById(RefMarital::class, $id);
        $this->description = $this->marital->description;
        $this->code = $this->marital->code;
        $this->setupModal("update", "Update Marital", "Marital", "update({$id})");
        $this->resetValidation(); // Clear validation errors
    }

    protected function formatData()
    {
        return [
            'code' => FormattingService::formatCode($this->code, true),
            'description' => FormattingService::formatDescription($this->description),
        ];
    }

    public function create()
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefMarital::class, $formattedData['code'])) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            ModelService::create(RefMarital::class, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefMarital::class, $id, $formattedData['code'])) {
            ModelService::update(RefMarital::class, $id, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id,$code)
    {
    $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you sure you want to delete code:' . $code .'?', $id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefMarital::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(RefMarital::class, $this->paginated, false, $this->searchQuery);

        return view('livewire.admin.maintenance.marital', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}