<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\AddressType;
use App\Services\Maintenance\AddTypeService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class AddType extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|max:3|alpha')]
    public $code;

    #[Rule('required|string')]
    public $description;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $addtype;
    public $paginated;

    protected $addtypeService;
    protected $popupService;

    public function __construct()
    {
        $this->addtypeService = new AddTypeService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Address Type", "Address Type");
    }

    public function openUpdateModal($id)
    {
        $this->addtype = AddressType::find($id);
        $this->description = $this->addtype->description;
        $this->code = $this->addtype->code;

        $this->setupModal("update", "Update Address Type", "Address Type", "update({$id})");
    }

    public function create()
    {
        
        $this->validate();

        if (AddTypeService::isCodeExists($this->code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $data = [
                'description' => trim(strtoupper($this->description)),
                'code' => trim(strtoupper($this->code)),
            ];

            AddTypeService::createAddType($data);

            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if (AddTypeService::canUpdateCode($id, $this->code)) {
            $data = [
                'description' => trim(strtoupper($this->description)),
                'code' => trim(strtoupper($this->code)),
            ];

            AddTypeService::updateAddType($id, $data);
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
        AddTypeService::deleteAddType($id);
    }

    public function render()
    {
        $data = $this->addtypeService->getPaginatedAddTypes($this->paginated);

        return view('livewire.admin.maintenance.add-type', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
