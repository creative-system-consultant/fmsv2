<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefGlcode;
use App\Services\Maintenance\GlCodeService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class GlCode extends Component
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
    public $glcode;
    public $coopId;
    public $paginated;

    protected $glcodeService;
    protected $popupService;

    public function __construct()
    {
        $this->glcodeService = new GlCodeService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Race", "Race");
    }

    public function openUpdateModal($id)
    {
        $this->glcode = RefGlcode::find($id);
        $this->description = $this->glcode->description;
        $this->code = $this->glcode->code;
        $this->glcode->status == 1 ? $this->status = true : $this->status = false;
        $this->setupModal("update", "Update Race", "Race", "update({$id})");
    }

    public function create()
    {
        $this->validate();

        if ($this->glcodeService->isCodeExists($this->code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $this->glcodeService->createGlCode($this->description, $this->code, $this->status);
            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if ($this->glcodeService->canUpdateCode($id, $this->code)) {
            $this->glcodeService->updateGlcode($id, $this->description, $this->code, $this->status);
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
        $this->glcodeService->deleteGlcode($id);
    }

    #[Layout('layouts.main')]
    public function render()
    {
        $data = $this->glcodeService->getPaginatedGlcode($this->paginated);

        return view('livewire.admin.maintenance.glcode', [
            'data' => $data,
        ]);
    }
}
