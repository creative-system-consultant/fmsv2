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

    #[Rule('required|numeric|min:1|max:99')]
    public $code;

    #[Rule('required|regex:/^[A-Za-z ]+(\([A-Za-z]+\))?$/')]
    public $description;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $state;
    public $paginated;
    public $searchQuery;

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
        $this->reset(['description', 'code']); // Clear the values for description and code
        $this->resetValidation(); // Clear validation errors
    }

    public function openUpdateModal($id)
    {
        $this->state = RefState::find($id);
        $this->description = $this->state->description;
        $this->code = $this->state->code;
        $this->setupModal("update", "Update State", "State", "update({$id})");
        $this->resetValidation(); // Clear validation errors
    }

    public function create()
    {
        
        $this->validate();

        $paddedCode = str_pad(trim(strtoupper($this->code)), 2, '0', STR_PAD_LEFT);

        if (StateService::isCodeExists($paddedCode)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $data = [
                'description' => trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
                'code' => $paddedCode,
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
                'description' => trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
                'code' => str_pad(trim(strtoupper($this->code)), 2, '0', STR_PAD_LEFT),
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
        $data = $this->stateService->getStateResult($this->searchQuery, $this->paginated);

        return view('livewire.admin.maintenance.state', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
