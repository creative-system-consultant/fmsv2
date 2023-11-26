<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefState;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class State extends Component
{
    use Actions, WithPagination, MaintenanceModalTrait;

    // Properties for modal and state management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $state;

    // Properties for state data
    public $code;
    public $description;
    public $priority;

    // Pagination and searching
    public $paginated;
    public $searchQuery;

    // Services
    protected $popupService;

    protected function createRules()
    {
        return [
            'code' => 'required|numeric|min:1|max:99',
            'description' => ['required', new ValidDescription],
        ];
    }

    protected function updateRules()
    {
        return [
            'code' => 'required|numeric|min:1|max:99',
            'description' => ['required', new ValidDescription],
            'priority' => 'numeric|min:1|max:9999',
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create State", "State");
        $this->reset(['description', 'code']); // Clear the values for description and code
        $this->resetValidation(); // Clear validation errors
    }

    public function openUpdateModal($id)
    {
        $this->state = ModelService::findById(RefState::class, $id);
        $this->description = $this->state->description;
        $this->code = $this->state->code;
        $this->priority = $this->state->priority;
        $this->setupModal("update", "Update State", "State", "update({$id})");
        $this->resetValidation(); // Clear validation errors
    }

    protected function formatData()
    {
        return [
            'code' => FormattingService::formatCode($this->code, true),
            'description' => FormattingService::formatDescription($this->description),
            'priority' => $this->priority ?? 9999,
        ];
    }

    public function create()
    {
        $this->validate($this->createRules());

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefState::class, $formattedData['code'])) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            ModelService::create(RefState::class, $formattedData);
            $this->reset('code', 'description', 'priority');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate($this->updateRules());

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefState::class, $id, $formattedData['code'])) {
            ModelService::update(RefState::class, $id, $formattedData);
            $this->reset('code', 'description', 'priority');
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id, $description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you sure you want to delete ' . $description . '?', $id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefState::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefState::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
            [
                'priority' => 'ASC',
                'description' => 'ASC'
            ] // $orderByArray
        );

        return view('livewire.admin.maintenance.state', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
