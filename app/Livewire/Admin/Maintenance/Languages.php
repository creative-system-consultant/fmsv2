<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefLanguage;
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

class Languages extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    // Properties for modal and religion management
    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $language;

    // Properties for language data
    public $institute_id;
    public $description;

    // Pagination & searching
    public $paginated;
    public $searchQuery;

    // Services
    protected $popupService;

    public function rules()
    {
        return [
            'institute_id' => ['required', 'numeric', 'min:1', 'max:9'],
            'description' => ['required', new ValidDescription],
        ];
    }

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Language", "Language");
        $this->reset(['description', 'institute_id']);
        $this->resetValidation();
    }


    public function openUpdateModal($id)
    {
        $this->language = ModelService::findById(RefLanguage::class, $id);
        $this->description = $this->language->description;
        $this->institute_id = $this->language->institute_id;
        $this->setupModal("update", "Update Language", "Language", "update({$id})");
        $this->resetValidation(); // Clear validation errors
    }

    protected function formatData()
    {
        return [
            'institute_id' => FormattingService::formatCode($this->institute_id, true, 2),
            'description' => FormattingService::formatDescription($this->description),
        ];
    }

    public function create()
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::isCodeExists(RefLanguage::class, $formattedData['institute_id'], 'institute_id')) {
            $this->addError('institute_id', 'The institute id has already been taken.');
        } else {
            ModelService::create(RefLanguage::class, $formattedData);
            $this->reset('institute_id', 'description');
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $formattedData = $this->formatData();

        if (MaintenanceService::canUpdateCode(RefLanguage::class, $id, $formattedData['institute_id'], 'institute_id')) {
            ModelService::update(RefLanguage::class, $id, $formattedData);
            $this->reset('institute_id', 'description');
            $this->openModal = false;
        } else {
            $this->addError('institute_id', 'The institute id has already been taken.');
        }
    }

    public function delete($id, $institute_id)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you delete the Institute ID: '.$institute_id.'?',$id);
    }

    public function ConfirmDelete($id)
    {
        ModelService::delete(RefLanguage::class, $id);
    }

    public function render()
    {
        $data = MaintenanceService::getPaginated(
            RefLanguage::class,
            $this->paginated, // $perPage
            $this->searchQuery, // $searchQuery
        );

        return view('livewire.admin.maintenance.languages', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
