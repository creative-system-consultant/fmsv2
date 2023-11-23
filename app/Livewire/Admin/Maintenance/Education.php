<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefEducation;
use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Services\Model\EducationService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Education extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|alpha|max:9')]
    public $code;

    #[Rule('required|regex:/^[A-Za-z \/ ]+(\([A-Za-z]+\))?$/')]
    public $description;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $education;
    public $paginated;
    public $searchQuery;

    protected $educationService;
    protected $popupService;

    public function __construct()
    {
        $this->educationService = new EducationService();
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
        $this->education = RefEducation::find($id);
        $this->description = $this->education->description;
        $this->code = $this->education->code;
        $this->setupModal("update", "Update Education", "Education", "update({$id})");
        $this->resetValidation(); // Clear validation errors
    }

    public function create()
    {
        
        $this->validate();

        $trim_code = trim(strtoupper($this->code));

        if(strlen($trim_code) == 1) 

        if (EducationService::isCodeExists($trim_code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $data = [
                'description' => trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
                'code' => $trim_code,
            ];

            EducationService::createEducation($data);
            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        $trim_code = trim(strtoupper($this->code));

        if(strlen($trim_code) == 1) 

        if (EducationService::canUpdateCode($id, $trim_code)){
            $data = [
                'code' => $trim_code,
                'description' => trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
            ];
            EducationService::updateEducation($id, $data);
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
        EducationService::deleteEducation($id);
    }

    public function render()
    {
        $data = $this->educationService->getEducationResult($this->searchQuery, $this->paginated);

        return view('livewire.admin.maintenance.education', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}