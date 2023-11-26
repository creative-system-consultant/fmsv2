<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefGender;
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

class Gender extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and gender management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $gender;

    // Properties for gender data
    #[Rule('required|max:2|alpha')]
    public $code;

    #[Rule('required|string')]
    public $description;

    // Pagination & searching
    public $paginated;
    public $searchQuery;

    // Services
    protected $popupService;

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Gender", "Gender");
        $this->reset('code', 'description'); // Clear the values for description and code
        $this->resetValidation(); // Clear validation errors
    }

    public function openUpdateModal($id)
    {
        $this->gender = ModelService::findById(RefGender::class, $id);
        $this->description = $this->gender->description;
        $this->code = $this->gender->code;
        $this->setupModal("update", "Update Gender", "Gender", "update({$id})");
        $this->resetValidation(); // Clear validation errors
    }

    protected function formatData()
    {
        return [
            'code' => FormattingService::formatCode($this->code),
            'description' => FormattingService::formatDescription($this->description),
        ];
    }

    public function create()
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefGender::class, $formattedData['code'])) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            ModelService::create(RefGender::class, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefGender::class, $id, $formattedData['code'])) {
            ModelService::update(RefGender::class, $id, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id, $gender)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you delete Gender: ' .$gender. '?',$id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefGender::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefGender::class,
            $this->paginated, // $perPage
            $this->searchQuery // $searchQuery
        );

        return view('livewire.admin.maintenance.gender', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
