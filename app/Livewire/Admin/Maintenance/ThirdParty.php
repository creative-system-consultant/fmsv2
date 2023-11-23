<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefThirdParty;
use App\Services\Model\ThirdPartyService;
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

    #[Rule('required|string')]
    public $description;

    #[Rule('numeric|min:1|max:9999')]
    public $priority;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $thirdparty;
    public $paginated;
    public $searchQuery;
    public $prio_id;

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
        $this->reset(['description', 'trx_code']); // Clear the values for description and code
        $this->resetValidation(); // Clear validation errors    
    }

    public function openUpdateModal($id)
    {
        $this->prio_id = $id;
        $this->thirdparty = RefThirdParty::find($id);
        $this->description = $this->thirdparty->description;
        $this->trx_code = $this->thirdparty->trx_code;
        $this->priority = $this->thirdparty->priority;
        $this->setupModal("update", "Update ThirdParty", "ThirdParty", "update({$this->prio_id})");
        $this->resetValidation(); // Clear validation errors    
    }

    public function create()
    {
        
        $this->validate([
            'trx_code' => 'required|max_digits:4|numeric',
            'description' => 'required|string',
        ]);

        $paddedTrxCode = str_pad(trim($this->trx_code), 4, '0', STR_PAD_LEFT);

        if (ThirdPartyService::isTrxCodeExists($paddedTrxCode)) {
            $this->addError('trx_code', 'The Transaction Code has already been taken.');
        } else {
            $data = [
                'description' => trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
                'trx_code' => $paddedTrxCode,
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
                'description' => trim(preg_replace('/\s+/', ' ',strtoupper($this->description))),
                'trx_code' => str_pad(trim($this->trx_code), 4, '0', STR_PAD_LEFT),
                'priority' => $this->priority,
            ];

            ThirdPartyService::updateThirdParty($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('trx_code', 'The Code has already been taken.');
        }
    }
    public function delete($id,$description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you sure you want to delete  ' . $description .'?', $id);
    }

    public function ConfirmDelete($id)
    {
        ThirdPartyService::deleteThirdParty($id);
    }

    public function render()
    {
        $data = $this->thirdpartyService->getThirdPartyResult($this->searchQuery, $this->paginated);

        return view('livewire.admin.maintenance.third-party', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}

