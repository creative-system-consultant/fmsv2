<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefCountry;
use Livewire\Component;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use WireUi\Traits\Actions;
use Livewire\WithPagination;

class Country extends Component
{
    use Actions, WithPagination, MaintenanceModalTrait;

    // Properties for modal and state management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $country;

    // Properties for country data
    public $description;
    public $abbr;
    public $priority;

    // Pagination and searching
    public $paginated;
    public $searchQuery;

    // Services
    protected $popupService;

    protected function createRules()
    {
        return [
            'abbr' => 'required|min:2|max:2|alpha',
            'description' => ['required', new ValidDescription],
        ];
    }

    protected function updateRules()
    {
        return [
            'abbr' => 'required|min:2|max:2|alpha',
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
        $this->setupModal("create", "Create Country", "Country");
        $this->reset(['description', 'abbr']); // Clear the values for description and abbr
        $this->resetValidation(); // Clear validation errors
    }

    public function openUpdateModal($id)
    {
        $this->country = ModelService::findById(RefCountry::class, $id);
        $this->description = $this->country->description;
        $this->abbr = $this->country->abbr;
        $this->priority = $this->country->priority;
        $this->setupModal("update", "Update Country", "Country", "update({$id})");
        $this->resetValidation(); // Clear validation errors
    }

    protected function formatData()
    {
        return [
            'abbr' => FormattingService::formatCode($this->abbr),
            'description' => FormattingService::formatDescription($this->description),
            'priority' => $this->priority ?? 9999,
        ];
    }

    public function create()
    {
        $this->validate($this->createRules());

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefCountry::class, $formattedData['abbr'], 'abbr')) {
            $this->addError('abbr', 'The abbr has already been taken.');
        } else {
            ModelService::create(RefCountry::class, $formattedData);
            $this->reset('abbr', 'description', 'priority');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate($this->updateRules());

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefCountry::class, $id, $formattedData['abbr'], 'abbr')) {
            ModelService::update(RefCountry::class, $id, $formattedData);
            $this->reset('abbr', 'description', 'priority');
            $this->openModal = false;
        } else {
            $this->addError('abbr', 'The abbr has already been taken.');
        }
    }

    public function delete($id,$description)
    {
    $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you sure you want to delete country ' . $description .'?', $id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefCountry::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefCountry::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
            [
                'priority' => 'ASC',
                'description' => 'ASC'
            ] // $orderByArray
        );

        return view('livewire.admin.maintenance.country', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
