<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefEducation;
use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Services\Maintenance\EducationService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Education extends Component
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
    public $education;
    public $coopId;
    public $paginated;

    protected $educationService;
    protected $popupService;

    public function __construct()
    {
        $this->educationService = new EducationService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Education", "Education");
    }

    public function openUpdateModal($id)
    {
        $this->education = RefEducation::find($id);
        $this->description = $this->education->description;
        $this->code = $this->education->code;
        $this->education->status == 1 ? $this->status = true : $this->status = false;
        $this->setupModal("update", "Update Education", "Education", "update({$id})");
    }

    public function create()
    {
        $this->validate();

        if ($this->educationService->isCodeExists($this->code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $this->educationService->createEducation($this->description, $this->code, $this->status);
            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if ($this->educationService->canUpdateCode($id, $this->code)) {
            $this->educationService->updateEducation($id, $this->description, $this->code, $this->status);
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
        $this->educationService->deleteEducation($id);
    }

    #[Layout('layouts.main')]
    public function render()
    {
        $data = $this->educationService->getPaginatedEducation($this->paginated);

        return view('livewire.admin.maintenance.education',[
            'data' => $data,
        ]);
    }
}
