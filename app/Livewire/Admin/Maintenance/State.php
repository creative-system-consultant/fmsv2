<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefState;
use App\Services\Model\StateService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class State extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|numeric')]
    public $code;

    #[Rule('required|alpha')]
    public $description;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $state;
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

        $this->setupModal("update", "Update State", "State", "update({$id})");
    }

    public function create()
    {
        
        $this->validate();

        if (StateService::isCodeExists($this->code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $data = [
                'description' => trim(strtoupper($this->description)),
                'code' => trim(strtoupper($this->code)),
            ];

            StateService::createState($data);

            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if (StateService::canUpdateCode($id, $this->code)) {
            $data = [
                'description' => trim(strtoupper($this->description)),
                'code' => trim(strtoupper($this->code)),
            ];

            StateService::updateState($id, $data);
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
        StateService::deleteState($id);
    }

    public function render()
    {
        $data = $this->stateService->getPaginatedStates($this->paginated);

        return view('livewire.admin.maintenance.state', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
