<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefEmployerList;
use App\Services\General\PopupService;
use App\Services\Model\EmployerListService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class EmployerList extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|alpha|max:20')]
    public $employer_id;
    
    #[Rule('required|regex:/^[A-Za-z ]+(\([A-Za-z]+\))?$/')]
    public $employer_name;
    
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $employerList;
    public $paginated;
    public $searchQuery;

    protected $employerList_Service;
    protected $popupService;

    public function __construct()
    {
        $this->employerList_Service = new EmployerListService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Employer List", "Description");
        $this->reset(['employer_id','employer_name']);
        $this->resetValidation();
    }

    public function openUpdateModal($employer_id)
    {
        $this->employerList = RefEmployerList::find($employer_id);
        $this->employer_id = $this->employerList->employer_id;
        $this->employer_name = $this->employerList->employer_name;
        $this->setupModal("update", "Update Employer List", "Description", "update({$employer_id})");
        $this->resetValidation();
    }

    public function create()
    {
        $this->validate();
        
        if (EmployerListService::isCodeExists($this->employer_id)) {
            $this->addError('employer_id', 'The code has already been taken.');
        } else {
            $data = [
                'employer_id' => trim(strtoupper($this->employer_id)),
                'employer_name'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->employer_name))),
            ];
            EmployerListService::createEmployerList($data);
            $this->reset();
            $this->openModal = false;
        }
    }
    
    public function update($id)
    {
        $this->validate();
        
        if (EmployerListService::canUpdateCode($id, $this->employer_id)){
            $data = [
                'employer_id' => trim(strtoupper($this->employer_id)),
                'employer_name'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->employer_name))),
            ];
            EmployerListService::updateEmployerList($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('employer_id', 'The code has already been taken.');
        }
    }

    public function delete($id, $employer_id, $employer_name)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 
        "Are you sure to delete code " . $employer_id . " : " . $employer_name . " ? ",$id);
    }

    public function ConfirmDelete($id)
    {
        EmployerListService::deleteEmployerList($id);
    }
    
    public function render()
    {
        $data = $this->employerList_Service->getEmployerListResult($this->searchQuery, $this->paginated);
        return view('livewire.admin.maintenance.employer-list',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}
