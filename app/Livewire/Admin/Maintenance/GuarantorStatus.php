<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefGuarantorStatus;
use App\Services\General\PopupService;
use App\Services\Model\GuarantorStatusService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class GuarantorStatus extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|numeric|min:1|max:99')]
    public $code;
    
    #[Rule('required|regex:/^[A-Za-z\s]*$/|max:50')]
    public $description;
    
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $guarantorStatus;
    public $paginated;
    public $searchQuery;

    protected $guarantor_Service;
    protected $popupService;


    public function __construct()
    {
        $this->guarantor_Service = new GuarantorStatusService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Guarantor Status", "Description");
        $this->reset(['code','description']);
        $this->resetValidation();
    }

    public function openUpdateModal($code)
    {
        $this->guarantorStatus = RefGuarantorStatus::find($code);
        $this->code = $this->guarantorStatus->code;
        $this->description = $this->guarantorStatus->description;
        $this->setupModal("update", "Update Guarantor Status", "Description", "update({$code})");
        $this->resetValidation();
    }

    public function create()
    {
        $this->validate();

        $trim_code = trim($this->code);

        if(strlen($trim_code) == 1) {
            $trim_code = '0' . $trim_code;
        }
        
        if (GuarantorStatusService::isCodeExists($trim_code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $data = [
                'code' => $trim_code,
                'description'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
            ];
            GuarantorStatusService::createGuarantorStatus($data);
            $this->reset();
            $this->openModal = false;
        }
    }
    
    public function update($id)
    {
        $this->validate();

        $trim_code = trim($this->code);

        if(strlen($trim_code) == 1) {
            $trim_code = '0' . $trim_code;
        }
        
        if (GuarantorStatusService::canUpdateCode($id, $trim_code)){
            $data = [
                'code' => $trim_code,
                'description'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
            ];
            GuarantorStatusService::updateGuarantorStatus($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id, $code, $description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 
        "Are you sure to delete CODE " . $code . " : ".$description." ? ",$id);
    }

    public function ConfirmDelete($id)
    {
        GuarantorStatusService::deleteGuarantorStatus($id);
    }
    
    public function render()
    {
        $data = $this->guarantor_Service->getGuarantorResult($this->searchQuery, $this->paginated);
        return view('livewire.admin.maintenance.guarantor-status',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}

