<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefThirdParty;
use App\Services\Maintenance\ThirdPartyService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class ThirdParty extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|max_digits:4|numeric')]
    public $trx_code;

    #[Rule('required|alpha')]
    public $description;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $thirdparty;
    public $paginated;

    protected $thirdpartyService;
    protected $popupService;

    public function __construct()
    {
        $this->thirdpartyService = new ThirdPartyService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Third Party", "Third Party");
    }

    public function openUpdateModal($id)
    {
        $this->thirdparty = RefThirdParty::find($id);
        $this->description = $this->thirdparty->description;
        $this->trx_code = $this->thirdparty->trx_code;

        $this->setupModal("update", "Update ThirdParty", "ThirdParty", "update({$id})");
    }

    public function create()
    {
        
        $this->validate();

        if (ThirdPartyService::isTrxCodeExists($this->trx_code)) {
            $this->addError('trx_code', 'The code has already been taken.');
        } else {
            $data = [
                'description' => trim(strtoupper($this->description)),
                'trx_code' => trim(strtoupper($this->trx_code)),
            ];

            ThirdPartyService::createThirdParty($data);

            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if (ThirdPartyService::canUpdateTrxCode($id, $this->trx_code)) {
            $data = [
                'description' => trim(strtoupper($this->description)),
                'trx_code' => trim(strtoupper($this->trx_code)),
            ];

            ThirdPartyService::updateThirdParty($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('trx_code', 'The code has already been taken.');
        }
    }

    public function delete($id)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you delete the information?',$id);
    }

    public function ConfirmDelete($id)
    {
        ThirdPartyService::deleteThirdParty($id);
    }

    public function render()
    {
        $data = $this->thirdpartyService->getPaginatedThirdPartys($this->paginated);

        return view('livewire.admin.maintenance.third-party', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}

