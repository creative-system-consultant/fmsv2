<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefPosition;
use App\Services\General\PopupService;
use App\Services\Model\PositionService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Position extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|numeric|min:1|max:99')]
    public $code;
    
    #[Rule('required|regex:/^[A-Za-z\s]+(\([A-Za-z]+\))?$/')]
    public $description;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $position;
    public $paginated;
    public $searchQuery;

    protected $position_Service;
    protected $popupService;

    public function __construct()
    {
        $this->position_Service = new PositionService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Position", "Description");
        $this->reset(['code','description']);
        $this->resetValidation();
    }

    public function openUpdateModal($id)
    {
        $this->position = RefPosition::find($id);
        $this->code = $this->position->code;
        $this->description = $this->position->description;
        $this->setupModal("update", "Update Position", "Description", "update({$id})");
        $this->resetValidation();
    }

    public function create()
    {
        $this->validate();
        
        if(strlen($this->code) == 1) {     // klau code input 1 no, tmbah prefix 0
            $this->code = '0' . $this->code;
        }
        $this->description = str_replace(" ","",$this->description);

        if (PositionService::isCodeExists($this->code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $data = [
                'code' => $this->code,
                'description'=>$this->description 
            ];
            PositionService::createPositionService($data);
            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if (PositionService::canUpdateCode($id, $this->code)) {
    
            $data = [
                'code' => str_pad(trim(strtoupper($this->code)), 2, '0', STR_PAD_LEFT),
                'description' => trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
            ];
            PositionService::updatePositionService($id, $data);
            $this->openModal = false;

        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id,$code)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', "Are you sure want to delete code: ".$code."?",$id);
    }

    public function ConfirmDelete($id)
    {
        PositionService::deletePositionService($id);
    }

    public function render()
    {
        $data = $this->position_Service->getPositionResult($this->searchQuery, $this->paginated);
        return view('livewire.admin.maintenance.position', [
            'data' => $data
            ])->extends('layouts.main');
    }

}
