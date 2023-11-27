<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefEmployerList;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class EmployerList extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and employer list management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $employerList;

    // Properties for employer list data
    public $employer_id;
    public $employer_name;

    // Pagination & searching
    public $paginated;
    public $searchQuery;

    // Services
    protected $popupService;

    public function rules()
    {
        return [
            'employer_id' => ['required', 'alpha', 'max:20'],
            'employer_name' => ['required', new ValidDescription],
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Employer List", "Description");
        $this->reset(['employer_id','employer_name']);
        $this->resetValidation();
    }

    public function openUpdateModal($id)
    {
        $this->employerList = ModelService::findById(RefEmployerList::class, $id);
        $this->employer_id = $this->employerList->employer_id;
        $this->employer_name = $this->employerList->employer_name;
        $this->setupModal("update", "Update Employer List", "Description", "update({$id})");
        $this->resetValidation();
    }

    protected function formatData()
    {
        return [
            'employer_id' => FormattingService::formatCode($this->employer_id),
            'employer_name' => FormattingService::formatDescription($this->employer_name),
        ];
    }

    public function create()
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefEmployerList::class, $formattedData['employer_id'], 'employer_id')) {
            $this->addError('employer_id', 'The code has already been taken.');
        } else {
            ModelService::create(RefEmployerList::class, $formattedData);
            $this->reset('employer_id', 'employer_name');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefEmployerList::class, $id, $formattedData['employer_id'], 'employer_id')) {
            ModelService::update(RefEmployerList::class, $id, $formattedData);
            $this->reset('employer_id', 'employer_name');
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
        ModelService::delete(RefEmployerList::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefEmployerList::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
            [
                'employer_id' => 'ASC',
                'employer_name' => 'ASC'
            ]
        );

        return view('livewire.admin.maintenance.employer-list',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}
