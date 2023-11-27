<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefPaymentType;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class PaymentType extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and payment type management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $paymentType;

    // Properties for cust payment type data
    public $description;

    // Pagination & searching
    public $paginated;
    public $searchQuery;

    // Services
    protected $popupService;

    public function rules()
    {
        return [
            'description' => ['required', new ValidDescription, 'max:50'],
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Payment Type", "Description");
        $this->reset('description');
        $this->resetValidation();
    }

    public function openUpdateModal($description)
    {
        $this->paymentType = ModelService::findById(RefPaymentType::class, $description);
        $this->description = $this->paymentType->description;
        $this->setupModal("update", "Update Payment Type", "Description", "update({$description})");
        $this->resetValidation();
    }

    protected function formatData()
    {
        return [
            'description' => FormattingService::formatDescription($this->description),
        ];
    }

    public function create()
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefPaymentType::class, $formattedData['description'], 'description')) {
            $this->addError('description', 'The type has already been taken.');
        } else {
            ModelService::create(RefPaymentType::class, $formattedData);
            $this->reset('description');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefPaymentType::class, $id, $formattedData['description'], 'description')) {
            ModelService::update(RefPaymentType::class, $id, $formattedData);
            $this->reset('description');
            $this->openModal = false;
        } else {
            $this->addError('description', 'The type has already been taken.');
        }
    }

    public function delete($id, $description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', "Are you sure to delete STATUS : " . $description . "?",$id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefPaymentType::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefPaymentType::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
            [
                'description' => 'ASC'
            ]
        );

        return view('livewire.admin.maintenance.payment-type',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}
