<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefIncome;
use App\Services\General\PopupService;
use App\Services\Model\IncomeService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Income extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|numeric|min:1|max:99')]
    public $code;

    #[Rule('required|regex:/^\s*(\d+)\s*-\s*(\d+)\s*$/')]
    public $description;    
    
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $income;
    public $paginated;
    public $searchQuery;

    protected $income_Service;
    protected $popupService;


    public function __construct()
    {
        $this->income_Service = new IncomeService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Income", "Description");
        $this->reset(['code','description']);
        $this->resetValidation();
    }

    public function openUpdateModal($code)
    {
        $this->income = RefIncome::find($code);
        $this->code = $this->income->code;
        $this->description = $this->income->description;
        $this->setupModal("update", "Update Income", "Description", "update({$code})");
        $this->resetValidation();
    }

    public function create()
    {
        $this->validate();

        $trim_code = trim($this->code);

        if(strlen($trim_code) == 1) {
            $trim_code = '0' . $trim_code;
        }
        
        $this->description = str_replace(" ","",$this->description);
        $this->description = str_replace("-"," - ",$this->description);

        if (IncomeService::isCodeExists($trim_code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $data = [
                'description' => $this-> description,
                'code' => $trim_code,
            ];
            IncomeService::createIncome($data);
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
        $this->description = str_replace(" ","",$this->description);
        $this->description = str_replace("-"," - ",$this->description);

        if (IncomeService::canUpdateCode($id, $trim_code)){
            $data = [
                'code' => $trim_code,
                'description' => $this->description
            ];
            IncomeService::updateIncome($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id, $code, $description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', "Are you sure to delete CODE: " . $code . " and INCOME: " .$description. " ?",$id);
    }

    public function ConfirmDelete($id)
    {
        IncomeService::deleteIncome($id);
    }
    
    public function render()
    {
        $data = $this->income_Service->getIncomeResult($this->searchQuery, $this->paginated);
        return view('livewire.admin.maintenance.income',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}
