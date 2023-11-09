<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefLanguage;
use App\Services\Maintenance\LanguageService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Languages extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|numeric')]
    public $institute_id;

    #[Rule('required|alpha')]
    public $description;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $language;
    public $paginated;

    protected $languageService;
    protected $popupService;

    public function __construct()
    {
        $this->languageService = new LanguageService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Language", "Language");
    }

    public function openUpdateModal($id)
    {
        $this->language = RefLanguage::find($id);
        $this->description = $this->language->description;
        $this->institute_id = $this->language->institute_id;

        $this->setupModal("update", "Update Language", "Language", "update({$id})");
    }

    public function create()
    {
        
        $this->validate();

        if (LanguageService::isInstituteIdExists($this->institute_id)) {
            $this->addError('institute_id', 'The ID has already been taken.');
        } else {
            $data = [
                'description' => trim(strtoupper($this->description)),
                'institute_id' => trim(strtoupper($this->institute_id)),
            ];

            LanguageService::createLanguage($data);

            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if (LanguageService::canUpdateInstituteId($id, $this->institute_id)) {
            $data = [
                'description' => trim(strtoupper($this->description)),
                'institute_id' => trim(strtoupper($this->institute_id)),
            ];

            LanguageService::updateLanguage($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('institute_id', 'The ID has already been taken.');
        }
    }

    public function delete($id)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you delete the information?',$id);
    }

    public function ConfirmDelete($id)
    {
        LanguageService::deleteLanguage($id);
    }

    public function render()
    {
        $data = $this->languageService->getPaginatedLanguages($this->paginated);

        return view('livewire.admin.maintenance.languages', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}

