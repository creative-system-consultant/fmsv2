<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefEducation;
use Livewire\Component;
use App\Rules\Maintenance\ValidDescription;
use App\Services\General\ModelService;
use App\Services\General\PopupService;
use App\Services\Maintenance\FormattingService;
use App\Services\Maintenance\GeneralService as MaintenanceService;
use App\Traits\MaintenanceModalTrait;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Education extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and education management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $education;

    // Properties for education data
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
            'code' => ['required', 'alpha', 'max:9'],
            'description' => ['required', new ValidDescription],
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Education", "Education");
        $this->reset(['description', 'code']); // Clear the values for description and code
        $this->resetValidation(); // Clear validation errors
    }

    public function openUpdateModal($id)
    {
        $this->education = ModelService::findById(RefEducation::class, $id);
        $this->description = $this->education->description;
        $this->code = $this->education->code;
        $this->setupModal("update", "Update Education", "Education", "update({$id})");
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

        if (MaintenanceService::isCodeExists(RefEducation::class, $formattedData['code'])) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            ModelService::create(RefEducation::class, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefEducation::class, $id, $formattedData['code'])) {
            ModelService::update(RefEducation::class, $id, $formattedData);
            $this->reset('code', 'description');
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id,$code)
    {
    $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you sure you want to delete code:' . $code .'?', $id);
    }


    public function ConfirmDelete($id)
    {
        ModelService::delete(RefEducation::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefEducation::class,
            $this->paginated, // $perPage
            $this->searchQuery // $searchQuery
        );

        return view('livewire.admin.maintenance.education', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}