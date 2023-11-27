<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefOccupations;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;


class Occupation extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and occupation management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $occupation;

    // Properties for occupation data
    #[Rule('required|numeric|min:1|max:9999')]
    public $occup_id;

    #[Rule('required|string')]
    public $description;

    #[Rule('numeric|min:1|max:9999')]
    public $priority;

    // Pagination and searching
    public $paginated = 20;
    public $searchQuery;

    // Services
    protected $popupService;

    protected function createRules()
    {
        return [
            'occup_id' => 'required|numeric|min:1|max:99',
            'description' => 'required|string',
        ];
    }

    protected function updateRules()
    {
        return [
            'occup_id' => 'required|numeric|min:1|max:99',
            'description' => 'required|string',
            'priority' => 'numeric|min:1|max:9999',
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Occupation", "Occupation");
        $this->reset(['description', 'occup_id']); // Clear the values for description and occup_id
        $this->resetValidation(); // Clear validation errors
    }

    public function openUpdateModal($id)
    {
        $this->occupation = ModelService::findById(RefOccupations::class, $id);
        $this->description = $this->occupation->description;
        $this->occup_id = $this->occupation->occup_id;
        $this->priority = $this->occupation->priority;
        $this->setupModal("update", "Update Occupation", "Occupation", "update({$id})");
        $this->resetValidation(); // Clear validation errors
    }

    protected function formatData()
    {
        return [
            'occup_id' => FormattingService::formatCode($this->occup_id, true, 4),
            'description' => FormattingService::formatDescription($this->description),
            'priority' => $this->priority ?? 9999,
        ];
    }

    public function create()
    {
        $this->validate($this->createRules());

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefOccupations::class, $formattedData['occup_id'], 'occup_id')) {
            $this->addError('occup_id', 'The occupation id has already been taken.');
        } else {
            ModelService::create(RefOccupations::class, $formattedData);
            $this->reset('occup_id', 'description', 'priority');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate($this->updateRules());

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefOccupations::class, $id, $formattedData['occup_id'], 'occup_id')) {
            ModelService::update(RefOccupations::class, $id, $formattedData);
            $this->reset('occup_id', 'description', 'priority');
            $this->openModal = false;
        } else {
            $this->addError('occup_id', 'The occupation id has already been taken.');
        }
    }

    public function delete($id,$description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you sure you want to delete OCCUPATION: '.$description.'?', $id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefOccupations::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefOccupations::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
            [
                'priority' => 'ASC',
                'description' => 'ASC'
            ] // $orderByArray
        );

        return view('livewire.admin.maintenance.occupation', [
            'data' => $data,
        ])->extends('layouts.main');

    }
}