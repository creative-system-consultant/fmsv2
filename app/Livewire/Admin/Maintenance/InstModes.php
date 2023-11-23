<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefInstMode;
use App\Services\General\PopupService;
use App\Services\Model\InstModesService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;


class InstModes extends Component
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
    public $instMode;
    public $paginated;
    public $searchQuery;

    protected $instMode_Service;
    protected $popupService;

    public function __construct()
    {
        $this->instMode_Service = new InstModesService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Inst Mode", "Description");
        $this->reset(['code','description']);
        $this->resetValidation();
    }

    public function openUpdateModal($code)
    {
        $this->instMode = RefInstMode::find($code);
        $this->code = $this->instMode->code;
        $this->description = $this->instMode->description;
        $this->setupModal("update", "Update Inst Mode", "Description", "update({$code})");
        $this->resetValidation();
    }

    public function create()
    {
        $this->validate();

        $trim_code = trim($this->code);

        if(strlen($trim_code) == 1) {
            $trim_code = '0' . $trim_code;
        }
        
        if (InstModesService::isCodeExists($trim_code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $data = [
                'code' => $trim_code,
                'description'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
            ];
            InstModesService::createInstMode($data);
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
        
        if (InstModesService::canUpdateCode($id, $trim_code)){
            $data = [
                'code' => $trim_code,
                'description'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
            ];
            InstModesService::updateInstMode($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id, $code)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', "Are you sure to delete code: " . $code . "?",$id);
    }

    public function ConfirmDelete($id)
    {
        InstModesService::deleteInstMode($id);
    }
    
    public function render()
    {
        $data = $this->instMode_Service->getInstModeResult($this->searchQuery, $this->paginated);
        return view('livewire.admin.maintenance.inst-modes',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}
