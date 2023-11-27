<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefTakaful;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Takaful extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and takaful management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $takaful;

    // Properties for takaful data
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
            'description' => ['required', new ValidDescription],
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Takaful", "Description");
        $this->reset(['code','description']);
        $this->resetValidation();
    }

    public function openUpdateModal($id)
    {
        $this->takaful = ModelService::findById(RefTakaful::class, $id);
        $this->code = $this->takaful->code;
        $this->description = $this->takaful->description;
        $this->setupModal("update", "Update Takaful", "Description", "update({$id})");
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

        if (MaintenanceService::isCodeExists(RefTakaful::class, $formattedData['code'])) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            ModelService::create(RefTakaful::class, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefTakaful::class, $id, $formattedData['code'])) {
            ModelService::update(RefTakaful::class, $id, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id, $code, $description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?',
        "Are you sure to delete CODE " . $code . " : " .$description. "?",$id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefTakaful::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefTakaful::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
            [
                'code' => 'ASC',
                'description' => 'ASC'
            ]
        );

        return view('livewire.admin.maintenance.takaful',[
            'data' =>$data,
        ])->extends('layouts.main');
    }
}
