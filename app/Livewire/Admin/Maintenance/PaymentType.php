<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefPaymentType;
use App\Services\General\PopupService;
use App\Services\Model\PaymentTypeService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class PaymentType extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|regex:/^[A-Za-z\s\/]*$/|max:50')]
    public $description;
    
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $paymentType;
    public $paginated;
    public $searchQuery;
    public $priority;

    protected $paymentType_Service;
    protected $popupService;


    public function __construct()
    {
        $this->paymentType_Service = new PaymentTypeService();
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
        $this->paymentType = RefPaymentType::find($description);
        $this->description = $this->paymentType->description;
        $this->setupModal("update", "Update Payment Type", "Description", "update({$description})");
        $this->resetValidation();
    }

    public function create()
    {
        $this->validate();
        
        if (PaymentTypeService::isCodeExists($this->description)) {
            $this->addError('description', 'The status has already been taken.');
        } else {
            $data = [
                'description'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
            ];
            PaymentTypeService::createPaymentType($data);
            $this->reset();
            $this->openModal = false;
        }
    }
    
    public function update($id)
    {
        $this->validate();

        if (PaymentTypeService::canUpdatePaymentType($id, $this->description)){
            $data = [
                'description'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
            ];
            PaymentTypeService::updatePaymentType($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('description', 'The status has already been taken.');
        }
    }

    public function delete($id, $description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', "Are you sure to delete STATUS : " . $description . "?",$id);
    }

    public function ConfirmDelete($id)
    {
        PaymentTypeService::deletePaymentType($id);

    }
    
    public function render()
    {
        $data = $this->paymentType_Service->getPaymentTypeResult($this->searchQuery, $this->paginated);
        return view('livewire.admin.maintenance.payment-type',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}
