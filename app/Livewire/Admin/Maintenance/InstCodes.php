<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefInstCode;
use App\Services\General\PopupService;
use App\Services\Model\InstCodesService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class InstCodes extends Component
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
    public $instCode;
    public $paginated;
    public $searchQuery;

    protected $instCode_Service;
    protected $popupService;


    public function __construct()
    {
        $this->instCode_Service = new InstCodesService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Inst Code", "Description");
        $this->reset(['code','description']);
        $this->resetValidation();
    }

    public function openUpdateModal($code)
    {
        $this->instCode = RefInstCode::find($code);
        $this->code = $this->instCode->code;
        $this->description = $this->instCode->description;
        $this->setupModal("update", "Update Inst Code", "Description", "update({$code})");
        $this->resetValidation();
    }

    public function create()
    {
        $this->validate();

        $trim_code = trim($this->code);

        if(strlen($trim_code) == 1) {
            $trim_code = '0' . $trim_code;
        }
        
        if (InstCodesService::isCodeExists($trim_code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $data = [
                'code' => $trim_code,
                'description'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
            ];
            InstCodesService::createInstCode($data);
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
        
        if (InstCodesService::canUpdateCode($id, $trim_code)){
            $data = [
                'code' => $trim_code,
                'description'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
            ];
            InstCodesService::updateInstCode($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id, $code, $description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 
        "Are you sure to delete CODE " . $code . " : ". $description ."?",$id);
    }

    public function ConfirmDelete($id)
    {
        InstCodesService::deleteInstCode($id);
    }
    
    public function render()
    {
        $data = $this->instCode_Service->getInstCodeResult($this->searchQuery, $this->paginated);
        return view('livewire.admin.maintenance.inst-codes',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}