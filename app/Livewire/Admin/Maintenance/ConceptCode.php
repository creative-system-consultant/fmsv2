<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefConceptCodes;
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

class ConceptCode extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and concept code management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $conceptCode;

    // Properties for concept code data
    #[Rule('required|numeric|min:1|max:99')]
    public $code;

    #[Rule('required|string')]
    public $description;

    #[Rule('required|string')]
    public $concept;

    #[Rule('numeric|min:1|max:9999')]
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
            'description' => 'required|string',
            'concept' => 'required|string',
        ];
    }

    protected function updateRules()
    {
        return [
            'code' => 'required|numeric|min:1|max:99',
            'description' => 'required|string',
            'concept' => 'required|string',
            'priority' => 'numeric|min:1|max:9999',
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Concept Code", "Description");
        $this->reset(['description', 'code' , 'concept']); // Clear the values for description and code
        $this->resetValidation(); // Clear validation errors
    }

    public function openUpdateModal($id)
    {
        $this->conceptCode = RefConceptCodes::find($id);
        $this->description = $this->conceptCode->description;
        $this->code = $this->conceptCode->code;
        $this->priority = $this->conceptCode->priority;
        $this->concept = $this->conceptCode->concept;
        $this->setupModal("update", "Update Concept Code", "Description", "update({$id})");
        $this->resetValidation(); // Clear validation errors
    }

    protected function formatData()
    {
        return [
            'code' => FormattingService::formatCode($this->code, true),
            'description' => FormattingService::formatDescription($this->description),
            'concept' => FormattingService::formatDescription($this->concept),
            'priority' => $this->priority ?? 9999,
        ];
    }

    public function create()
    {
        $this->validate($this->createRules());

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefConceptCodes::class, $formattedData['code'])) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            ModelService::create(RefConceptCodes::class, $formattedData);
            $this->reset('code', 'description', 'concept', 'priority');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate($this->updateRules());

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefConceptCodes::class, $id, $formattedData['code'])) {
            ModelService::update(RefConceptCodes::class, $id, $formattedData);
            $this->reset('code', 'description', 'concept', 'priority');
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id,$description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you sure you want to delete '.$description.'?', $id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefConceptCodes::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefConceptCodes::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
            [
                'priority' => 'ASC',
                'description' => 'ASC'
            ] // $orderByArray
        );

        return view('livewire.admin.maintenance.concept-code', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}