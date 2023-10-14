<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefState;
use App\Services\Maintenance\StateService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class State extends Component
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
    public $state;
    public $coopId;
    public $paginated;

    protected $stateService;
    protected $popupService;

    public function __construct()
    {
        $this->stateService = new StateService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create State", "State");
    }

    public function openUpdateModal($id)
    {
        $this->state = RefState::find($id);
        $this->description = $this->state->description;
        $this->code = $this->state->code;
        $this->state->status == 1 ? $this->status = true : $this->status = false;

        $this->setupModal("update", "Update State", "State", "update({$id})");
    }

    public function create()
    {
        $this->validate();

        if ($this->stateService->isCodeExists($this->code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $this->stateService->createState($this->description, $this->code, $this->status);

            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if ($this->stateService->canUpdateCode($id, $this->code)) {
            $this->stateService->updateState($id, $this->description, $this->code, $this->status);
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
        $this->stateService->deleteState($id);
    }

    #[Layout('layouts.main')]
    public function render()
    {
        $data = $this->stateService->getPaginatedState($this->paginated);

        return view('livewire.admin.maintenance.state', [
            'data' => $data,
        ]);
    }
}
