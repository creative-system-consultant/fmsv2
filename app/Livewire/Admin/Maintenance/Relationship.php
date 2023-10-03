<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefRelationship;
use App\Services\Maintenance\RelationshipService;
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

    public function __construct()
    {
        $this->relationshipService = new RelationshipService();
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

        if ($this->relationshipService->isCodeExists($this->code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $this->relationshipService->createRelationship($this->description, $this->code, $this->status);

            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if ($this->relationshipService->canUpdateCode($id, $this->code)) {
            $this->relationshipService->updateRelationship($id, $this->description, $this->code, $this->status);
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id)
    {
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => 'Delete the information?',
            'icon'        => 'question',
            'accept'      => [
                'label'  => 'Yes, delete it',
                'method' => 'ConfirmDelete',
                'params' => $id,
            ],
            'reject' => [
                'label'  => 'No, cancel',
                'method' => 'cancel',
            ],
        ]);
    }

    public function ConfirmDelete($id)
    {
        $this->relationshipService->deleteRelationship($id);
    }

    public function render()
    {
        $data = $this->relationshipService->getPaginatedRelationships($this->paginated);

        return view('livewire.admin.maintenance.relationship', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
