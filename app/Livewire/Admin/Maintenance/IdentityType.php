<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefIdentityType;
use App\Services\Maintenance\IdentityTypeService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class IdentityType extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|string')]
    public $type;

    #[Rule('required|alpha')]
    public $description;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $identitytype;
    public $paginated;

    protected $identitytypeService;
    protected $popupService;

    public function __construct()
    {
        $this->identitytypeService = new IdentityTypeService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Identity Type", "Identity Type");
    }

    public function openUpdateModal($id)
    {
        $this->identitytype = RefIdentityType::find($id);
        $this->description = $this->identitytype->description;
        $this->type = $this->identitytype->type;

        $this->setupModal("update", "Update Identity Type", "Identity Type", "update({$id})");
    }

    public function create()
    {
        
        $this->validate();

        if (IdentityTypeService::isTypeExists($this->type)) {
            $this->addError('type', 'The type has already been taken.');
        } else {
            $data = [
                'description' => trim(strtoupper($this->description)),
                'type' => trim(strtoupper($this->type)),
            ];

            IdentityTypeService::createIdentityType($data);

            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if (IdentityTypeService::canUpdateType($id, $this->type)) {
            $data = [
                'description' => trim(strtoupper($this->description)),
                'type' => trim(strtoupper($this->type)),
            ];

            IdentityTypeService::updateIdentityType($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('type', 'The ID has already been taken.');
        }
    }

    public function delete($id)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you delete the information?',$id);
    }

    public function ConfirmDelete($id)
    {
        IdentityTypeService::deleteIdentityType($id);
    }

    public function render()
    {
        $data = $this->identitytypeService->getPaginatedIdentityTypes($this->paginated);

        return view('livewire.admin.maintenance.identity-type', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
