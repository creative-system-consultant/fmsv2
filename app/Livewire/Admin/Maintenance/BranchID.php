<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefBranchID;
use App\Services\General\PopupService;
use App\Services\Model\BranchIDService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class BranchId extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|numeric|min:1|max:9999')]
    public $branch_id;

    #[Rule('required|regex:/^[A-Za-z ]+(\([A-Za-z]+\))?$/')]
    public $branch_name;

    #[Rule('required|numeric|min:1|max:9999')]
    public $priority;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $branchid;
    public $paginated;
    public $searchQuery;
    public $branch;

    protected $branchid_Service;
    protected $popupService;

    public function __construct()
    {
        $this->branchid_Service = new BranchIDService();
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
        $this->branch = $id;
        $this->branchid = RefBranchID::find($id);
        $this->branch_id = $this->branchid->branch_id;
        $this->branch_name = $this->branchid->branch_name;
        $this->priority = $this->branchid->priority;

        $this->setupModal("update", "Update Branch", "Branch Name", "update({$this->branch})");
        $this->resetValidation();
    }

    public function create()
    {
        $this->validate();

        $paddedCode = str_pad(trim(strtoupper($this->branch_id)), 4, '0', STR_PAD_LEFT);

        if (BranchIDService::isCodeExists($paddedCode)) {
            $this->addError('branch_id', 'The code has already been taken.');
        } else {
            $data = [
                'branch_id' => $paddedCode,
                'branch_name' => trim(preg_replace('/\s+/', ' ', strtoupper($this->branch_name))),
            ];
            BranchIDService::createBranchIDService($data);
            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if (BranchIDService::canUpdateCode($id, $this->branch_id)) {
            $data = [
                'branch_id' => str_pad(trim(strtoupper($this->branch_id)), 4, '0', STR_PAD_LEFT),
                'branch_name' => trim(preg_replace('/\s+/', ' ', strtoupper($this->branch_name))),
                'priority' => $this->priority,
            ];
            BranchIDService::updateBranchIDService($id, $data);
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
        BranchIDService::deleteBranchIDService($id);
    }

    public function render()
    {
        $data = $this->branchid_Service->getBranchIDResult($this->searchQuery, $this->paginated);
        return view('livewire.admin.maintenance.branch-id', [
            'data' => $data
            ])->extends('layouts.main');
    }
}
