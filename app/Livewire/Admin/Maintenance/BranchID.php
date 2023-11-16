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

class BranchID extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|numeric|min:1|max:9999')]
    public $branch_id;
    
    #[Rule('required|regex:/^[A-Za-z ]+(\([A-Za-z]+\))?$/')]
    public $branch_name;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $branchid;
    public $paginated;
    public $searchQuery;

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
        $this->branch_id = '';   // Clear the values for branch_id and branch_name
        $this->branch_name = '';
    }

    public function openUpdateModal($branch_id)
    {
        $this->branchid = RefBranchID::find($branch_id);
        $this->branch_id = $this->branchid->branch_id;
        $this->branch_name = $this->branchid->branch_name;
        $this->setupModal("update", "Update Branch", "Branch Name", "update({$branch_id})");
    }

    public function create()
    {
        $this->validate();
        
        $paddedCode = str_pad(trim(strtoupper($this->branch_id)), 4, '0', STR_PAD_LEFT);

        if (BranchIDService::isCodeExists($paddedCode)) {
            $this->addError('branch_id', 'The code has already been taken.');
            $this->reset();
            
        } else {
            $data = [
                'branch_id' => $paddedCode,
                'branch_name' => trim(strtoupper($this->branch_name)),
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
                // Combine validation, trim, strtoupper, and str_pad for branch_id
                'branch_id' => str_pad(trim(strtoupper($this->branch_id)), 4, '0', STR_PAD_LEFT),
                'branch_name' => trim(strtoupper($this->branch_name)),
            ];
            BranchIDService::updateBranchIDService($id, $data);
            $this->openModal = false;

        } else {
            $this->addError('branch_id', 'The code has already been taken.');
        }
    }

    public function delete($id)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you delete the information?',$id);
    }

    public function ConfirmDelete($id)
    {
        BranchIDService::deleteBranchIDService($id);
    }

    public function render()
    {
        $data = $this->branchid_Service->getBranchResult($this->searchQuery, $this->paginated);
        return view('livewire.admin.maintenance.branch-i-d', [
            'data' => $data
            ])->extends('layouts.main');
    }
}
