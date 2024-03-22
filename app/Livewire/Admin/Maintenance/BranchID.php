<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefBranchID;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class BranchId extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and branch id management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $branchid;

    // Properties for branch id data
    public $branch_id;
    public $sys_desc;
    public $branch_name;
    public $priority;

    // Pagination and searching
    public $paginated;
    public $searchQuery;
    public $orderBy = 'default';

    // Services
    protected $popupService;

    protected function createRules()
    {
        return [
            'branch_id' => 'required|numeric|min:1|max:99',
            'branch_name' => ['required', new ValidDescription],
        ];
    }

    protected function updateRules()
    {
        return [
            'branch_id' => 'required|numeric|min:1|max:99',
            'branch_name' => ['required', new ValidDescription],
            'priority' => 'numeric|min:1|max:9999',
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Branch", "Branch Name");
        $this->reset(['branch_id','branch_name']);
        $this->resetValidation();
    }

    public function openUpdateModal($id)
    {
        $this->branchid = ModelService::findById(RefBranchID::class, $id);
        $this->branch_id = $this->branchid->branch_id;
        $this->sys_desc = $this->branchid->sys_desc;
        $this->branch_name = $this->branchid->branch_name;
        $this->priority = $this->branchid->priority;

        $this->setupModal("update", "Update Branch", "Branch Name", "update({$id})");
        $this->resetValidation();
    }

    protected function formatData()
    {
        return [
            'branch_id' => FormattingService::formatCode($this->branch_id, true, 4),
            'branch_name' => FormattingService::formatDescription($this->branch_name),
            'priority' => $this->priority ?? 9999,
        ];
    }

    public function create()
    {
        $this->validate($this->createRules());

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefBranchID::class, $formattedData['branch_id'], 'branch_id')) {
            $this->addError('branch_id', 'The code has already been taken.');
        } else {
            ModelService::create(RefBranchID::class, $formattedData);
            $this->reset('branch_id', 'branch_name', 'priority');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate($this->updateRules());

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefBranchID::class, $id, $formattedData['branch_id'], 'branch_id')) {
            ModelService::update(RefBranchID::class, $id, $formattedData);
            $this->reset('branch_id', 'branch_name', 'priority');
            $this->openModal = false;
        } else {
            $this->addError('branch_id', 'The code has already been taken.');
        }
    }

    public function delete($id, $branch_id, $branch_name)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', "Are you delete the Branch ID " .$branch_id. " : ".$branch_name."?",$id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefBranchID::class, $id);
    }

    public function render()
    {
        if ($this->orderBy == 'default') {
            $orderBy = [
                'priority' => 'ASC',
                'branch_name' => 'ASC'
            ];
        } else {
            $orderBy = [
                $this->orderBy => 'ASC'
            ];
        }

        $data = MaintenanceService::getPaginated(
            RefBranchID::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
            $orderBy // $orderByArray
            // [
            //     'priority' => 'ASC',
            //     'branch_name' => 'ASC'
            // ] // $orderByArray
        );

        return view('livewire.admin.maintenance.branch-id', [
            'data' => $data
            ])->extends('layouts.main');
    }
}
