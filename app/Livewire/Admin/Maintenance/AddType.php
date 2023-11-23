<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\AddressType;
use App\Services\Model\AddTypeService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class AddType extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|max:1|alpha')]
    public $code;

    #[Rule('required|regex:/^[A-Za-z\/\s]+$/')]
    public $description;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $addtype;
    public $paginated;
    public $searchQuery;

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
        $this->reset(['description', 'code']); // Clear the values for description and code
        $this->resetValidation(); // Clear validation errors    
    }

    public function openUpdateModal($id)
    {
        $this->addtype = AddressType::find($id);
        $this->description = $this->addtype->description;
        $this->code = $this->addtype->code;
        $this->setupModal("update", "Update Address Type", "Address Type", "update({$id})");
        $this->resetValidation(); // Clear validation errors
    
    }

    public function create()
    {
        
        $this->validate();

        $paddedCode = str_pad(trim(strtoupper($this->code)), 1, STR_PAD_LEFT);

        if (AddTypeService::isCodeExists($paddedCode)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $data = [
                'description' => trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
                'code' => $paddedCode,
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
                'description' => trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
                'code' => str_pad(trim(strtoupper($this->code)), 1, STR_PAD_LEFT),
            ];

            AddTypeService::updateAddType($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id,$code)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you delete the CODE: '.$code.'?',$id);
    }

    public function ConfirmDelete($id)
    {
        AddTypeService::deleteAddType($id);
    }

    public function render()
    {
        $data = $this->addtypeService->getAddTypeResult($this->searchQuery, $this->paginated);

        return view('livewire.admin.maintenance.add-type', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
