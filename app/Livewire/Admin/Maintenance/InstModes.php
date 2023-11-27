<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefInstMode;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class InstModes extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and insti mode management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $instMode;

    // Properties for insti mode data
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
        $this->setupModal("create", "Create Inst Mode", "Description");
        $this->reset(['code','description']);
        $this->resetValidation();
    }

    public function openUpdateModal($id)
    {
        $this->instMode = ModelService::findById(RefInstMode::class, $id);
        $this->code = $this->instMode->code;
        $this->description = $this->instMode->description;
        $this->setupModal("update", "Update Inst Mode", "Description", "update({$id})");
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

        if (MaintenanceService::isCodeExists(RefInstMode::class, $formattedData['code'])) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            ModelService::create(RefInstMode::class, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefInstMode::class, $id, $formattedData['code'])) {
            ModelService::update(RefInstMode::class, $id, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id, $code)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', "Are you sure to delete code: " . $code . "?",$id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefInstMode::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefInstMode::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
            [
                'code' => 'ASC',
                'description' => 'ASC'
            ]
        );

        return view('livewire.admin.maintenance.inst-modes',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}
