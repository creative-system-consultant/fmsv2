<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefReligion;
use App\Services\Model\ReligionService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Religion extends Component
{
    use Actions, WithPagination, MaintenanceModalTrait;

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
    public $paginated;

    protected $religionService;
    protected $popupService;

    public function __construct()
    {
        $this->religionService = new ReligionService();
        $this->popupService = app(PopupService::class);
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
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you delete the information?',$id);
    }

    public function ConfirmDelete($id)
    {
        $this->religionService->deleteReligion($id);
    }

    public function render()
    {
        $data = $this->religionService->getPaginatedReligions($this->paginated);

        return view('livewire.admin.maintenance.religion', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
