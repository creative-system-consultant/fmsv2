<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefThirdParty;
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

class ThirdParty extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and third party management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $thirdparty;

    // Properties for third party data
    #[Rule('required|max_digits:4|numeric')]
    public $trx_code;

    #[Rule('required|string')]
    public $description;

    #[Rule('numeric|min:1|max:9999')]
    public $priority;

    // Pagination & searching
    public $paginated;
    public $searchQuery;

    // Services
    protected $popupService;

    protected function createRules()
    {
        return [
            'trx_code' => 'required|max_digits:4|numeric',
            'description' => 'required|string',
        ];
    }

    protected function updateRules()
    {
        return [
            'trx_code' => 'required|max_digits:4|numeric',
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
        $this->setupModal("create", "Create Third Party", "Third Party");
        $this->reset(['description', 'trx_code']); // Clear the values for description and code
        $this->resetValidation(); // Clear validation errors
    }

    public function openUpdateModal($id)
    {
        $this->thirdparty = ModelService::findById(RefThirdParty::class, $id);
        $this->description = $this->thirdparty->description;
        $this->trx_code = $this->thirdparty->trx_code;
        $this->priority = $this->thirdparty->priority;
        $this->setupModal("update", "Update ThirdParty", "ThirdParty", "update({$id})");
        $this->resetValidation(); // Clear validation errors
    }

    protected function formatData()
    {
        return [
            'trx_code' => FormattingService::formatCode($this->trx_code, true, 4),
            'description' => FormattingService::formatDescription($this->description),
            'priority' => $this->priority ?? 9999,
        ];
    }

    public function create()
    {
        $this->validate($this->createRules());

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefThirdParty::class, $formattedData['trx_code'], 'trx_code')) {
            $this->addError('trx_code', 'The code has already been taken.');
        } else {
            ModelService::create(RefThirdParty::class, $formattedData);
            $this->reset('trx_code', 'description', 'priority');
            $this->openModal = false;
        }
    }
    public function update($id)
    {
        $this->validate($this->updateRules());

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefThirdParty::class, $id, $formattedData['trx_code'], 'trx_code')) {
            ModelService::update(RefThirdParty::class, $id, $formattedData);
            $this->reset('trx_code', 'description', 'priority');
            $this->openModal = false;
        } else {
            $this->addError('trx_code', 'The code has already been taken.');
        }
    }
    public function delete($id,$description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you sure you want to delete  ' . $description .'?', $id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefThirdParty::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefThirdParty::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
            [
                'priority' => 'ASC',
                'description' => 'ASC'
            ] // $orderByArray
        );

        return view('livewire.admin.maintenance.third-party', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
