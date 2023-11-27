<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefGuarantorStatus;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class GuarantorStatus extends Component
{
    use Actions, WithPagination, MaintenanceModalTrait;

    // Properties for modal and guarantor status management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $guarantorStatus;

    // Properties for guarantor status data
    public $code;
    public $description;

    // Pagination & searching
    public $paginated;
    public $searchQuery;

    // Services
    protected $popupService;

    public function rules()
    {
        return [
            'code' => ['required', 'numeric', 'min:1', 'max:99'],
            'description' => ['required', new ValidDescription, 'max:50'],
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Guarantor Status", "Description");
        $this->reset(['code','description']);
        $this->resetValidation();
    }

    public function openUpdateModal($id)
    {
        $this->guarantorStatus = ModelService::findById(RefGuarantorStatus::class, $id);
        $this->code = $this->guarantorStatus->code;
        $this->description = $this->guarantorStatus->description;
        $this->setupModal("update", "Update Guarantor Status", "Description", "update({$id})");
        $this->resetValidation();
    }

    protected function formatData()
    {
        return [
            'code' => FormattingService::formatCode($this->code, true),
            'description' => FormattingService::formatDescription($this->description),
        ];
    }

    public function create()
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefGuarantorStatus::class, $formattedData['code'])) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            ModelService::create(RefGuarantorStatus::class, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefGuarantorStatus::class, $id, $formattedData['code'])) {
            ModelService::update(RefGuarantorStatus::class, $id, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id, $code, $description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?',
        "Are you sure to delete CODE " . $code . " : ".$description." ? ",$id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefGuarantorStatus::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefGuarantorStatus::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
            [
                'code' => 'ASC',
                'description' => 'ASC'
            ]
        );

        return view('livewire.admin.maintenance.guarantor-status',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}
