<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefDepartment;
use App\Services\General\PopupService;
use App\Services\Model\DepartmentService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Department extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|numeric|min:1|max:99')]
    public $dept_kod;
    
    #[Rule('required|regex:/^[A-Za-z ]+(\([A-Za-z]+\))?$/')]
    public $dept_desc;
    
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $department;
    public $paginated;
    public $searchQuery;

    protected $department_Service;
    protected $popupService;

    public function __construct()
    {
        $this->department_Service = new DepartmentService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Department", "Description");
        $this->reset(['dept_kod','dept_desc']);
        $this->resetValidation();
    }

    public function openUpdateModal($dept_kod)
    {
        $this->department = RefDepartment::find($dept_kod);
        $this->dept_kod = $this->department->dept_kod;
        $this->dept_desc = $this->department->dept_desc;
        $this->setupModal("update", "Update Department", "Description", "update({$dept_kod})");
        $this->resetValidation();
    }

    public function create()
    {
        $this->validate();

        $trim_code = trim($this->dept_kod);

        if(strlen($trim_code) == 1) {
            $trim_code = '0' . $trim_code;
        }
        
        if (DepartmentService::isCodeExists($trim_code)) {
            $this->addError('dept_kod', 'The code has already been taken.');
        } else {
            $data = [
                'dept_kod' => $trim_code,
                'dept_desc'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->dept_desc))),
            ];
            DepartmentService::createDepartment($data);
            $this->reset();
            $this->openModal = false;
        }
    }
    
    public function update($id)
    {
        $this->validate();

        $trim_code = trim($this->dept_kod);

        if(strlen($trim_code) == 1) {
            $trim_code = '0' . $trim_code;
        }
        
        if (DepartmentService::canUpdateCode($id, $trim_code)){
            $data = [
                'dept_kod' => $trim_code,
                'dept_desc'=> trim(preg_replace('/\s+/', ' ', strtoupper($this->dept_desc))),
            ];
            DepartmentService::updateDepartment($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('dept_kod', 'The code has already been taken.');
        }
    }

    public function delete($id, $dept_kod)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', "Are you sure to delete code: " . $dept_kod . "?",$id);
    }

    public function ConfirmDelete($id)
    {
        DepartmentService::deleteDepartment($id);
    }
    
    public function render()
    {
        $data = $this->department_Service->getDepartmentResult($this->searchQuery, $this->paginated);
        return view('livewire.admin.maintenance.department',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}
