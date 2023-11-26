<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\AddressType as ModelAddressType;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class AddressType extends Component
{
    use Actions, WithPagination, MaintenanceModalTrait;

    // Properties for modal and address type management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $addressType;

    // Properties for address type data
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
            'code' => ['required', 'alpha', 'max:1'],
            'description' => ['required', new ValidDescription],
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Address Type", "Address Type");
        $this->reset(['description', 'code']); // Clear the values for description and code
        $this->resetValidation(); // Clear validation errors
    }

    public function openUpdateModal($id)
    {
        $this->addressType = ModelService::findById(ModelAddressType::class, $id);
        $this->description = $this->addressType->description;
        $this->code = $this->addressType->code;
        $this->setupModal("update", "Update Address Type", "Address Type", "update({$id})");
        $this->resetValidation(); // Clear validation errors

    }

    protected function formatData()
    {
        return [
            'code' => FormattingService::formatCode($this->code, true, 1),
            'description' => FormattingService::formatDescription($this->description),
        ];
    }

    public function create()
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(ModelAddressType::class, $formattedData['code'])) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            ModelService::create(ModelAddressType::class, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(ModelAddressType::class, $id, $formattedData['code'])) {
            ModelService::update(ModelAddressType::class, $id, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id, $code)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you delete the CODE: ' . $code . '?', $id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(ModelAddressType::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            ModelAddressType::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
        );

        return view('livewire.admin.maintenance.address-type', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
