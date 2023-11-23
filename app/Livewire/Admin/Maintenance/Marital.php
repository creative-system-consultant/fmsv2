<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefMarital;
use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Services\Model\MaritalService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Marital extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|numeric|min:1|max:99')]
    public $code;

    #[Rule('required|regex:/^[A-Za-z ]+(\([A-Za-z]+\))?$/')]
    public $description;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $marital;
    public $paginated;
    public $searchQuery;

    protected $maritalService;
    protected $popupService;

    public function __construct()
    {
        $this->maritalService = new MaritalService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Marital", "Marital");
        $this->reset(['description', 'code']); // Clear the values for description and code
        $this->resetValidation(); // Clear validation errors
    }

    public function openUpdateModal($id)
    {
        $this->marital = RefMarital::find($id);
        $this->description = $this->marital->description;
        $this->code = $this->marital->code;
        $this->setupModal("update", "Update Marital", "Marital", "update({$id})");
        $this->resetValidation(); // Clear validation errors
    }

    public function create()
    {
        
        $this->validate();

        $trim_code = trim($this->code);

        if(strlen($trim_code) == 1) {
            $trim_code = '0' . $trim_code;
        }

        if (MaritalService::isCodeExists($trim_code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $data = [
                'description' => trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
                'code' => $trim_code,
            ];

            MaritalService::createMarital($data);
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

        if (MaritalService::canUpdateCode($id, $trim_code)){
            $data = [
                'code' => $trim_code,
                'description' => trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
            ];
            MaritalService::updateMarital($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id,$code)
    {
    $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you sure you want to delete code:' . $code .'?', $id);
    }
    
    
    public function ConfirmDelete($id)
    {
        MaritalService::deleteMarital($id);
    }

    public function render()
    {
        $data = $this->maritalService->getMaritalResult($this->searchQuery, $this->paginated);

        return view('livewire.admin.maintenance.marital', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}