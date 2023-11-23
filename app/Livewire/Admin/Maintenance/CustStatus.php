<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefCustStatus;
use App\Services\General\PopupService;
use App\Services\Model\CustStatusService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class CustStatus extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|regex:/^[A-Za-z\s]*$/|max:50')]
    public $description;
    
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $custStatus;
    public $paginated;
    public $searchQuery;

    protected $custStatus_Service;
    protected $popupService;


    public function __construct()
    {
        $this->custStatus_Service = new CustStatusService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Customer Status", "Description");
        $this->reset('description');
        $this->resetValidation();
    }

    public function openUpdateModal($description)
    {
        $this->custStatus = RefCustStatus::find($description);
        $this->description = $this->custStatus->description;
        $this->setupModal("update", "Update Customer Status", "Description", "update({$description})");
        $this->resetValidation();
    }

    public function create()
    {
        $this->validate();
        
        if (CustStatusService::isCodeExists($this->description)) {
            $this->addError('description', 'The status has already been taken.');
        } else {
            $data = [
                'description'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
            ];
            CustStatusService::createCustStatus($data);
            $this->reset();
            $this->openModal = false;
        }
    }
    
    public function update($id)
    {
        $this->validate();

        if (CustStatusService::canUpdateStatus($id, $this->description)){
            $data = [
                'description'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
            ];
            CustStatusService::updateCustStatus($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('description', 'The status has already been taken.');
        }
    }

    public function delete($id, $description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', "Are you sure to delete status: " . $description . "?",$id);
    }

    public function ConfirmDelete($id)
    {
        CustStatusService::deleteCustStatus($id);
    }
    
    public function render()
    {
        $data = $this->custStatus_Service->getCustStatusResult($this->searchQuery, $this->paginated);
        return view('livewire.admin.maintenance.cust-status',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}