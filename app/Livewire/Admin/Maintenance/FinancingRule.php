<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefFinancingRule;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class FinancingRule extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and financing rule management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $financingRule;

    // Properties for financing rule data
    public $code;
    public $description;

    // Pagination and searching
    public $paginated;
    public $searchQuery;

    // Services
    protected $popupService;

    public function rules()
    {
        return [
            'code' => ['required', 'numeric', 'min:1', 'max:9999'],
            'description' => ['required', new ValidDescription],
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Financing Rule", "Financing Rule");
        $this->reset(['description', 'code']); // Clear the values for description and code
        $this->resetValidation(); // Clear validation errors
    }

    public function openUpdateModal($id)
    {
        $this->financingRule = ModelService::findById(RefFinancingRule::class, $id);
        $this->description = $this->financingRule->description;
        $this->code = $this->financingRule->code;
        $this->setupModal("update", "Update Financing Rule", "Financing Rule", "update({$id})");
        $this->resetValidation(); // Clear validation errors
    }

    protected function formatData()
    {
        return [
            'code' => FormattingService::formatCode($this->code, true, 4),
            'description' => FormattingService::formatDescription($this->description),
        ];
    }

    public function create()
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefFinancingRule::class, $formattedData['code'])) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            ModelService::create(RefFinancingRule::class, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefFinancingRule::class, $id, $formattedData['code'])) {
            ModelService::update(RefFinancingRule::class, $id, $formattedData);
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
        ModelService::delete(RefFinancingRule::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefFinancingRule::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
        );

        return view('livewire.admin.maintenance.financing-rule', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
