<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefDepartment;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Department extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and department management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $department;

    // Properties for department data
    public $dept_kod;
    public $dept_desc;

    // Pagination & searching
    public $paginated;
    public $searchQuery;

    // Services
    protected $popupService;

    public function rules()
    {
        return [
            'dept_kod' => ['required', 'numeric', 'min:1', 'max:99'],
            'dept_desc' => ['required', new ValidDescription],
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Department", "Description");
        $this->reset(['dept_kod','dept_desc']);
        $this->resetValidation();
    }

    public function openUpdateModal($id)
    {
        $this->department = ModelService::findById(RefDepartment::class, $id);
        $this->dept_kod = $this->department->dept_kod;
        $this->dept_desc = $this->department->dept_desc;
        $this->setupModal("update", "Update Department", "Description", "update({$id})");
        $this->resetValidation();
    }

    protected function formatData()
    {
        return [
            'dept_kod' => FormattingService::formatCode($this->dept_kod, true),
            'dept_desc' => FormattingService::formatDescription($this->dept_desc),
        ];
    }

    public function create()
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefDepartment::class, $formattedData['dept_kod'], 'dept_kod')) {
            $this->addError('dept_kod', 'The code has already been taken.');
        } else {
            ModelService::create(RefDepartment::class, $formattedData);
            $this->reset('dept_kod', 'dept_desc');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefDepartment::class, $id, $formattedData['dept_kod'], 'dept_kod')) {
            ModelService::update(RefDepartment::class, $id, $formattedData);
            $this->reset('dept_kod', 'dept_desc');
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
        ModelService::delete(RefDepartment::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefDepartment::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
            [
                'dept_kod' => 'ASC',
                'dept_desc' => 'ASC'
            ]
        );

        return view('livewire.admin.maintenance.department',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}
