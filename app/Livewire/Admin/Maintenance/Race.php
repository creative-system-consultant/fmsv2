<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefRace;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Race extends Component
{
    use Actions, WithPagination, MaintenanceModalTrait;

    // Properties for modal and race management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $race;

    // Properties for relationship data
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
        $this->setupModal("create", "Create Race", "Race");
        $this->reset(['description', 'code']); // Clear the values for description and code
        $this->resetValidation(); // Clear validation errors
    }

    public function openUpdateModal($id)
    {
        $this->race = ModelService::findById(RefRace::class, $id);
        $this->description = $this->race->description;
        $this->code = $this->race->code;
        $this->priority = $this->race->priority;
        $this->resetValidation(); // Clear validation errors
        $this->setupModal("update", "Update Race", "Race", "update({$id})");
    }

    protected function formatData()
    {
        return [
            'code' => FormattingService::formatCode($this->code),
            'description' => FormattingService::formatDescription($this->description),
            'priority' => $this->priority ?? 9999,
        ];
    }

    public function create()
    {
        $this->validate($this->createRules());

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefRace::class, $formattedData['code'])) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            ModelService::create(RefRace::class, $formattedData);
            $this->reset('code', 'description', 'priority');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate($this->updateRules());

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefRace::class, $id, $formattedData['code'])) {
            ModelService::update(RefRace::class, $id, $formattedData);
            $this->reset('code', 'description', 'priority');
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id,$description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you delete the'.$description.'?',$id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefRace::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(RefRace::class, $this->paginated, true, $this->searchQuery);

        return view('livewire.admin.maintenance.race', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
