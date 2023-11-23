<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefConceptCodes;
use App\Services\Model\ConceptCodeService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;


class ConceptCode extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|numeric|min:1|max:99')]
    public $code;

    #[Rule('required|string')]
    public $description;

    #[Rule('required|string')]
    public $concept;

    #[Rule('numeric|min:1|max:9999')]
    public $priority;


    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $conceptCode;
    public $paginated;
    public $searchQuery;
    public $prio_id;

    protected $conceptCodeService;
    protected $popupService;

    public function __construct()
    {
        $this->conceptCodeService = new ConceptCodeService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Concept Code", "Description");
        $this->reset(['description', 'code' , 'concept']); // Clear the values for description and code
        $this->resetValidation(); // Clear validation errors
    }

    public function openUpdateModal($id)
    {
        $this->prio_id = $id;
        $this->conceptCode = RefConceptCodes::find($id);
        $this->description = $this->conceptCode->description;
        $this->code = $this->conceptCode->code;
        $this->priority = $this->conceptCode->priority;
        $this->concept = $this->conceptCode->concept;
        $this->setupModal("update", "Update Concept Code", "Description", "update({$this->prio_id})");
        $this->resetValidation(); // Clear validation errors
    }

    public function create()
    {
        
        $this->validate([
            'code' => 'required|numeric|min:1|max:99',
            'description' => 'required|string',
            'concept' => 'required|string',
    ]);

        $paddedCode = str_pad(trim($this->code), 2, '0', STR_PAD_LEFT);

        if (ConceptCodeService::isCodeExists($paddedCode)) {
            $this->addError('code', 'The Code id has already been taken.');
        } else {
            $data = [
                'description' => trim(strtoupper(preg_replace('/\s+/', ' ', ($this->description)))),
                'code' => $paddedCode,
                'concept' => trim(strtoupper(preg_replace('/\s+/', ' ', ($this->concept)))),
            ];

            ConceptCodeService::createConceptCode($data);
            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if (ConceptCodeService::canUpdateCode($id, $this->code)) {
            $data = [
                'description' => trim(strtoupper(preg_replace('/\s+/', ' ',($this->description)))),
                'code' => str_pad(trim($this->code), 2, '0', STR_PAD_LEFT),
                'priority' => $this->priority,
                'concept' => trim(strtoupper(preg_replace('/\s+/', ' ', ($this->concept)))),
            ];

            ConceptCodeService::updateConceptCode($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('code', 'The ConceptCode ID has already been taken.');
        }
    }

    public function delete($id,$description)
    {
    $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you sure you want to delete '.$description.'?', $id);
    }
    
    public function ConfirmDelete($id)
    {
        ConceptCodeService::deleteConceptCode($id);
    }

    public function render()
    {  
        $data = $this->conceptCodeService->getConceptCodeResult($this->searchQuery, $this->paginated);

        return view('livewire.admin.maintenance.concept-code', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}