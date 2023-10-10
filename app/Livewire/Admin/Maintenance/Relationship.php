<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefRelationship;
use App\Services\General\PopupService;
use App\Services\Model\RelationshipService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Relationship extends Component
{
    use Actions, WithPagination, MaintenanceModalTrait;

    #[Rule('required|max:3|alpha')]
    public $code;

    #[Rule('required|string')]
    public $description;

    #[Rule('nullable|boolean')]
    public $status;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $relationship;
    public $coopId;
    public $paginated;

    protected $relationshipService;
    protected $popupService;

    public function __construct()
    {
        $this->relationshipService = new RelationshipService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Relationship", "Relationship");
    }

    public function openUpdateModal($id)
    {
        $this->relationship = RefRelationship::find($id);
        $this->description = $this->relationship->description;
        $this->code = $this->relationship->code;
        $this->relationship->status == 1 ? $this->status = true : $this->status = false;

        $this->setupModal("update", "Update Relationship", "Relationship", "update({$id})");
    }

    public function create()
    {
        $this->validate();

        if (RelationshipService::isCodeExists($this->code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $data = [
                'description' => trim(strtoupper($this->description)),
                'code' => trim(strtoupper($this->code)),
                'status' => $this->status == true ? '1' : '0',
            ];

            RelationshipService::createRelationship($data);

            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if (RelationshipService::canUpdateCode($id, $this->code)) {
            $data = [
                'description' => trim(strtoupper($this->description)),
                'code' => trim(strtoupper($this->code)),
                'status' => $this->status == true ? '1' : '0',
            ];

            RelationshipService::updateRelationship($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you delete the information?',$id);
    }

    public function ConfirmDelete($id)
    {
        RelationshipService::deleteRelationship($id);
    }

    public function render()
    {
        $data = RelationshipService::getPaginatedRelationships($this->paginated);

        return view('livewire.admin.maintenance.relationship', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
