<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefBank;
use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Services\Maintenance\BankService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Bank extends Component
{
    use Actions,WithPagination,MaintenanceModalTrait;

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
    public $bank;
    public $coopId;
    public $paginated;

    protected $bankService;
    protected $popupService;

    public function __construct()
    {
        $this->bankService = new BankService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Bank", "Bank");
    }

    public function openUpdateModal($id)
    {
        $this->bank = RefBank::find($id);
        $this->description = $this->bank->description;
        $this->code = $this->bank->code;
        $this->bank->status == 1 ? $this->status = true : $this->status = false;
        $this->setupModal("update", "Update Bank", "Bank", "update({$id})");
    }

    public function create()
    {
        $this->validate();

        if ($this->bankService->isCodeExists($this->code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $this->bankService->createBank($this->description, $this->code, $this->status);
            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if ($this->bankService->canUpdateCode($id, $this->code)) {
            $this->bankService->updateBank($id, $this->description, $this->code, $this->status);
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
        $this->bankService->deleteBank($id);
    }

    public function render()
    {
        $data = $this->bankService->getPaginatedBank($this->paginated);

        return view('livewire.admin.maintenance.bank',[
            'data' => $data,
        ])->extends('layouts.main');
    }
}
