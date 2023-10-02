<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefReligion;
use App\Services\Maintenance\ReligionService;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Religion extends Component
{
    use Actions, WithPagination;

    #[Rule('required|string')]
    public $description;

    #[Rule('required|max:3|alpha')]
    public $code;

    #[Rule('nullable|boolean')]
    public $status;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $religion;

    protected $religionService;

    public function __construct()
    {
        $this->religionService = app(ReligionService::class);
    }

    private function setupModal($method, $title, $description, $actualMethod = null)
    {
        $this->openModal = true;
        $this->modalTitle = $title;
        $this->modalDescription = $description;
        $this->modalMethod = $actualMethod ?? $method;
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Religion", "Religion");
    }

    public function openUpdateModal($id)
    {
        $this->religion = RefReligion::find($id);
        $this->description = $this->religion->description;
        $this->code = $this->religion->code;
        $this->religion->status == 1 ? $this->status = true : $this->status = false;

        $this->setupModal("update", "Update Religion", "Religion", "update({$id})");
    }

    public function create()
    {
        $this->validate();

        if ($this->religionService->isCodeExists($this->code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $this->religionService->createReligion($this->description, $this->code, $this->status);

            // clear input field
            $this->reset();
            // close modal
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if ($this->religionService->canUpdateCode($id, $this->code)) {
            $this->religionService->updateReligion($id, $this->description, $this->code, $this->status);
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
            'reject' =>
            [
                'label'  => 'No, cancel',
                'method' => 'cancel',
            ],
        ]);
    }

    public function ConfirmDelete($id)
    {
        $this->religionService->deleteReligion($id);
    }

    public function render()
    {
        $data = $this->religionService->getPaginatedReligions();

        return view('livewire.admin.maintenance.religion', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
