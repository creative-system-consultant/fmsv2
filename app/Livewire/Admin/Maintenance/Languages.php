<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefLanguage;
use App\Services\Model\LanguageService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Languages extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|numeric|min:1|max:9')]
    public $institute_id;

    #[Rule('required|regex:/^[A-Za-z ]+(\([A-Za-z]+\))?$/')]
    public $description;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $language;
    public $paginated;
    public $searchQuery;

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
        $this->reset(['description', 'institute_id']); 
        $this->resetValidation(); 
    }


    public function openUpdateModal($id)
    {
        $this->language = RefLanguage::find($id);
        $this->description = $this->language->description;
        $this->institute_id = $this->language->institute_id;
        $this->setupModal("update", "Update Language", "Language", "update({$id})");
        $this->resetValidation(); // Clear validation errors
    }

    public function create()
    {
        
        $this->validate();

        $paddedCode = str_pad(trim(strtoupper($this->institute_id)), 2, '0', STR_PAD_LEFT);

        if (LanguageService::isInstituteIdExists($this->institute_id)) {
            $this->addError('institute_id', 'The ID has already been taken.');
        } else {
            $data = [
                'description' =>  trim(strtoupper(preg_replace('/\s+/', ' ', ($this->description)))),
                'institute_id' => $paddedCode,
            ];

            LanguageService::createLanguage($data);

            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $trim_code = trim($this->institute_id);

        if(strlen($trim_code) == '1') {
            $trim_code = '0' . $trim_code;
        }
        if (LanguageService::canUpdateInstituteId($id, $trim_code)){
            $data = [
                'institute_id' => $trim_code,
                'description' => trim(strtoupper(preg_replace('/\s+/', ' ', ($this->description)))),
            ];
            LanguageService::updateLanguage($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('institute_id', 'The institute id has already been taken.');
    }
    }

    public function delete($id,$institute_id)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you delete the Institute ID: '.$institute_id.'?',$id);
    }

    public function ConfirmDelete($id)
    {
        LanguageService::deleteLanguage($id);
    }

    public function render()
    {
        $data = $this->languageService->getLanguageResult($this->searchQuery, $this->paginated);

        return view('livewire.admin.maintenance.languages', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}

