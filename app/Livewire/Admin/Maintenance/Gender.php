<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefGender;
use App\Services\Maintenance\GenderService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Gender extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

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
    public $gender;
    public $coopId;
    public $paginated;

    protected $genderService;
    protected $popupService;

    public function __construct()
    {
        $this->genderService = new GenderService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Gender", "Gender");
    }

    public function openUpdateModal($id)
    {
        $this->gender = RefGender::find($id);
        $this->description = $this->gender->description;
        $this->code = $this->gender->code;
        $this->gender->status == 1 ? $this->status = true : $this->status = false;
        $this->setupModal("update", "Update Gender", "Gender", "update({$id})");
    }

    public function create()
    {
        $this->validate();

        if ($this->genderService->isCodeExists($this->code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $this->genderService->createGender($this->description, $this->code, $this->status);
            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if ($this->genderService->canUpdateCode($id, $this->code)) {
            $this->genderService->updateGender($id, $this->description, $this->code, $this->status);
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
        $this->genderService->deleteGender($id);
    }

    public function render()
    {
        $data = $this->genderService->getPaginatedGender($this->paginated);

        return view('livewire.admin.maintenance.gender', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
