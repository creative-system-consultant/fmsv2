<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefCustType;
use App\Services\General\PopupService;
use App\Services\Model\CustTypeService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class CustType extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|alpha|max:1')]
    public $cust_type;
    
    #[Rule('required|regex:/^[A-Za-z\s]*$/|max:50')]
    public $description;
    
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $custType;
    public $paginated;
    public $searchQuery;

    protected $custType_Service;
    protected $popupService;


    public function __construct()
    {
        $this->custType_Service = new CustTypeService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Customer Type", "Description");
        $this->reset(['cust_type','description']);
        $this->resetValidation();
    }

    public function openUpdateModal($cust_type)
    {
        $this->custType = RefCustType::find($cust_type);
        $this->cust_type = $this->custType->cust_type;
        $this->description = $this->custType->description;
        $this->setupModal("update", "Update Customer Type", "Description", "update({$cust_type})");
        $this->resetValidation();
    }

    public function create()
    {
        $this->validate();

        $trim_code = trim($this->cust_type);
        
        if (CustTypeService::isCodeExists($trim_code)) {
            $this->addError('cust_type', 'The code has already been taken.');
        } else {
            $data = [
                'cust_type' => strtoupper($trim_code),
                'description'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
            ];
            CustTypeService::createCustType($data);
            $this->reset();
            $this->openModal = false;
        }
    }
    
    public function update($id)
    {
        $this->validate();

        $trim_code = trim($this->cust_type);

        if (CustTypeService::canUpdateCode($id, $trim_code)){
            $data = [
                'cust_type' => strtoupper($trim_code),
                'description'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
            ];
            CustTypeService::updateCustType($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('cust_type', 'The code has already been taken.');
        }
    }

    public function delete($id, $cust_type, $description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', "Are you sure to delete STATUS " . $cust_type . " : "
        . $description . "?",$id);
    }

    public function ConfirmDelete($id)
    {
        CustTypeService::deleteCustType($id);
    }
    
    public function render()
    {
        $data = $this->custType_Service->getCustTypeResult($this->searchQuery, $this->paginated);
        return view('livewire.admin.maintenance.cust-type',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}
