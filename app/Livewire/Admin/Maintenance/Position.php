<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefPosition;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Position extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and position management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $position;

    // Properties for position data
    public $code;
    public $description;

    // Pagination and searching
    public $paginated;
    public $searchQuery;

    // Services
    protected $popupService;

    public function rules()
    {
        return [
            'code' => 'required|numeric|min:1|max:99',
            'description' => ['required', new ValidDescription, 'max:50'],
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Position", "Description");
        $this->reset(['code','description']);
        $this->resetValidation();
    }

    public function openUpdateModal($id)
    {
        $this->position = ModelService::findById(RefPosition::class, $id);
        $this->code = $this->position->code;
        $this->description = $this->position->description;
        $this->setupModal("update", "Update Position", "Description", "update({$id})");
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

        if (MaintenanceService::isCodeExists(RefPosition::class, $formattedData['code'])) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            ModelService::create(RefPosition::class, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefPosition::class, $id, $formattedData['code'])) {
            ModelService::update(RefPosition::class, $id, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id, $code, $description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?',
        "Are you sure want to delete CODE ".$code. " : " .$description. " ? ",$id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefPosition::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefPosition::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
            [
                'code' => 'ASC',
                'description' => 'ASC'
            ] // $orderByArray
        );

        return view('livewire.admin.maintenance.position', [
            'data' => $data
            ])->extends('layouts.main');
    }

}
