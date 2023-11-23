<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefReligion;
use App\Services\Model\ReligionService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Religion extends Component
{
    use Actions, WithPagination, MaintenanceModalTrait;

    #[Rule('required|regex:/^[A-Za-z ]+(\([A-Za-z]+\))?$/')]
    public $description;

    #[Rule('required|min:2|max:2|alpha')]
    public $code;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $religion;
    public $paginated;
    public $searchQuery;

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
        $this->reset(['description', 'code']); // Clear the values for description and code
        $this->resetValidation(); // Clear validation errors
    }

    public function openUpdateModal($id)
    {
        $this->religion = RefReligion::find($id);
        $this->description = $this->religion->description;
        $this->code = $this->religion->code;
        $this->setupModal("update", "Update Religion", "Religion", "update({$id})");
        $this->resetValidation(); // Clear validation errors
    }

    public function create()
    {
        
        $this->validate();

        $paddedCode = str_pad(trim(strtoupper($this->code)), 2,'A', STR_PAD_LEFT);

        if (ReligionService::isCodeExists($paddedCode)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $data = [
                'description' => trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
                'code' => $paddedCode,
            ];

            ReligionService::createReligion($data);
            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if (ReligionService::canUpdateCode($id, $this->code)) {
            $data = [
                'description' => trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
                'code' => str_pad(trim(strtoupper($this->code)), 2, 'A', STR_PAD_LEFT),
            ];

            ReligionService::updateReligion($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id,$code)
    {
    $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you sure you want to delete CODE: ' . $code .'?', $id);
    }

    public function ConfirmDelete($id)
    {
        ReligionService::deleteReligion($id);
    }

    public function render()
    {
        $data = $this->religionService->getReligionResult($this->searchQuery, $this->paginated);

        return view('livewire.admin.maintenance.religion', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
