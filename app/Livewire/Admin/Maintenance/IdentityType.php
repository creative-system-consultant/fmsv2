<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefIdentityType;
use App\Services\Model\IdentityTypeService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class IdentityType extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|string|min:3|max:3')]
    public $type;

    #[Rule('required|regex:/^[A-Za-z\/\s]+$/')]
    public $description;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $identitytype;
    public $paginated;
    public $searchQuery;

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
        $this->reset(['description', 'type']); // Clear the values for description and code
        $this->resetValidation(); // Clear validation errors    
    }

    public function openUpdateModal($id)
    {
        $this->identitytype = RefIdentityType::find($id);
        $this->description = $this->identitytype->description;
        $this->type = $this->identitytype->type;
        $this->setupModal("update", "Update Identity Type", "Identity Type", "update({$id})");
        $this->resetValidation(); // Clear validation errors
    }

    public function create()
    {
        
        $this->validate();

        $paddedType = str_pad(trim(strtoupper($this->type)), 3, STR_PAD_LEFT);

        if (IdentityTypeService::isTypeExists($paddedType)) {
            $this->addError('type', 'The type has already been taken.');
        } else {
            $data = [
                'description' => trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
                'type' => $paddedType,
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
                'description' => trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
                'type' => str_pad(trim(strtoupper($this->type)), 3, STR_PAD_LEFT),
            ];

            IdentityTypeService::updateIdentityType($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('type', 'The ID has already been taken.');
        }
    }

    public function delete($id,$type)
    {
    $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', "Are you sure you want to delete TYPE: ".$type."?", $id);
    }

    public function ConfirmDelete($id)
    {
        IdentityTypeService::deleteIdentityType($id);
    }

    public function render()
    {
        $data = $this->identitytypeService->getIdentityTypeResult($this->searchQuery, $this->paginated);

        return view('livewire.admin.maintenance.identity-type', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
