<?php

namespace App\Livewire\Admin\Maintenance;

use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class FinancingRule extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|alpha')]
    public $code;

    #[Rule('required|string')]
    public $description;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $education;
    public $coopId;
    public $paginated;

    protected $educationService;
    protected $popupService;

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create  Financing Rule", " Financing Rule");
    }

    public function openUpdateModal($id)
    {
        $this->setupModal("update", "Update Financing Rule", "Financing Rule", "update({$id})");
    }

    public function create()
    {
        
    }

    public function update($id)
    {
        
    }

    public function delete($id)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you delete the information?',$id);
    }

    public function ConfirmDelete($id)
    {
    
    }
    
    public function render()
    {
        return view('livewire.admin.maintenance.financing-rule')->extends('layouts.main');
    }
}
