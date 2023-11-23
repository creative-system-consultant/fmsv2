<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefGender;
use App\Services\Maintenance\GenderService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;

use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Gender extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|max:2|numeric')]
    public $institute_id;

    #[Rule('required|string')]
    public $description;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $gender;
    public $coopId;
    public $paginated;
    public $searchQuery;

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
        $this->reset(['description', 'institute_id']); // Clear the values for description and code
        $this->resetValidation(); // Clear validation errors
    }

    public function openUpdateModal($id)
    {
        $this->gender = RefGender::find($id);
        $this->description = $this->gender->description;
        $this->institute_id = $this->gender->institute_id;
        $this->setupModal("update", "Update Gender", "Gender", "update({$id})");
        $this->resetValidation(); // Clear validation errors
    }

    public function create()
    {
        $this->validate();

        if ($this->genderService->isInstituteIdExists($this->institute_id)) {
            $this->addError('institute_id', 'The institute id has already been taken.');
        } else {
            $this->genderService->createGender($this->description, $this->institute_id);
            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if ($this->genderService->canUpdateInstituteId($id, $this->institute_id)) {
            $this->genderService->updateGender($id, $this->description, $this->institute_id);
            $this->openModal = false;
        } else {
            $this->addError('institute_id', 'The institute id has already been taken.');
        }
    }

    public function delete($id,$institute_id)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you delete INSTITUTE ID: ' .$institute_id. '?',$id);
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
