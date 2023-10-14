<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefMarital;
use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Services\Maintenance\MaritalService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Marital extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|alpha')]
    public $code;

    #[Rule('required|string')]
    public $description;

    #[Rule('nullable|boolean')]
    public $status;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $marital;
    public $coopId;
    public $paginated;

    protected $maritalService;
    protected $popupService;

    public function __construct()
    {
        $this->maritalService = new MaritalService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Marital", "Marital");
    }

    public function openUpdateModal($id)
    {
        $this->marital = RefMarital::find($id);
        $this->description = $this->marital->description;
        $this->code = $this->marital->code;
        $this->marital->status == 1 ? $this->status = true : $this->status = false;
        $this->setupModal("update", "Update Marital", "Marital", "update({$id})");
    }

    public function create()
    {
        $this->validate();

        if ($this->maritalService->isCodeExists($this->code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $this->maritalService->createMarital($this->description, $this->code, $this->status);
            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if ($this->maritalService->canUpdateCode($id, $this->code)) {
            $this->maritalService->updateMarital($id, $this->description, $this->code, $this->status);
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
        $this->maritalService->deleteMarital($id);
    }

    public function render()
    {
        $data = $this->maritalService->getPaginatedMarital($this->paginated);

        return view('livewire.admin.maintenance.marital',[
            'data' => $data,
        ])->extends('layouts.main');
    }
}
