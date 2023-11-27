<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefCustType;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class CustType extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and cust type management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $custType;

    // Properties for cust type data
    public $cust_type;
    public $description;

    // Pagination & searching
    public $paginated;
    public $searchQuery;

    // Services
    protected $popupService;

    public function rules()
    {
        return [
            'cust_type' => ['required', 'alpha', 'max:1'],
            'description' => ['required', new ValidDescription],
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Customer Type", "Description");
        $this->reset(['cust_type','description']);
        $this->resetValidation();
    }

    public function openUpdateModal($id)
    {
        $this->custType = ModelService::findById(RefCustType::class, $id);
        $this->cust_type = $this->custType->cust_type;
        $this->description = $this->custType->description;
        $this->setupModal("update", "Update Customer Type", "Description", "update({$id})");
        $this->resetValidation();
    }

    protected function formatData()
    {
        return [
            'cust_type' => FormattingService::formatCode($this->cust_type),
            'description' => FormattingService::formatDescription($this->description),
        ];
    }

    public function create()
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefCustType::class, $formattedData['cust_type'], 'cust_type')) {
            $this->addError('cust_type', 'The code has already been taken.');
        } else {
            ModelService::create(RefCustType::class, $formattedData);
            $this->reset('cust_type', 'description');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefCustType::class, $id, $formattedData['cust_type'], 'cust_type')) {
            ModelService::update(RefCustType::class, $id, $formattedData);
            $this->reset('cust_type', 'description');
            $this->openModal = false;
        } else {
            $this->addError('cust_type', 'The code has already been taken.');
        }
    }

    public function delete($id, $cust_type, $description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', "Are you sure to delete STATUS " . $cust_type . " : " . $description . "?",$id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefCustType::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefCustType::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
            [
                'cust_type' => 'ASC',
                'description' => 'ASC'
            ]
        );

        return view('livewire.admin.maintenance.cust-type',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}
