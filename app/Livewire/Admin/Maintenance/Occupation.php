<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefOccupations;
use App\Services\Model\OccupationService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;


class Occupation extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|numeric|min:1|max:9999')]
    public $occup_id;

    #[Rule('required|string')]
    public $description;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $occupation;
    public $paginated;
    public $searchQuery;
    public $occ_id;

    protected $occupationService;
    protected $popupService;

    public function __construct()
    {
        $this->occupationService = new OccupationService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Occupation", "Occupation");
        $this->reset(['description', 'occup_id']); // Clear the values for description and occup_id
        $this->resetValidation(); // Clear validation errors
    }

    public function openUpdateModal($id)
    {
        $this->occ_id = $id;
        $this->occupation = RefOccupations::find($id);
        $this->description = $this->occupation->description;
        $this->occup_id = $this->occupation->occup_id;
        $this->setupModal("update", "Update Occupation", "Occupation", "update({$this->occ_id})");
        // dd([
        //     'openModal'=> $this->openModal,
        //     'modalMethod' => $this->modalMethod
        // ]);
        $this->resetValidation(); // Clear validation errors
    }

    public function create()
    {
        
        $this->validate();

        $paddedOccupId = str_pad(trim($this->occup_id), 4, '0', STR_PAD_LEFT);

        if (OccupationService::isOccupIdExists($paddedOccupId)) {
            $this->addError('occup_id', 'The occupation id has already been taken.');
        } else {
            $data = [
                'description' => trim(preg_replace('/\s+/', ' ', ($this->description))),
                'occup_id' => $paddedOccupId,
            ];

            OccupationService::createOccupation($data);
            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if (OccupationService::canUpdateOccupId($id, $this->occup_id)) {
            $data = [
                'description' => trim(preg_replace('/\s+/', ' ',($this->description))),
                'occup_id' => str_pad(trim($this->occup_id), 4, '0', STR_PAD_LEFT),
            ];

            OccupationService::updateOccupation($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('occup_id', 'The Occupation ID has already been taken.');
        }
    }

    public function delete($id,$occup_id)
    {
    $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you sure you want to delete Occupation ID: ' . $occup_id .'?', $id);
    }
    
    
    public function ConfirmDelete($id)
    {
        OccupationService::deleteOccupation($id);
    }

    public function render()
    {
        $data = $this->occupationService->getOccupationResult($this->searchQuery, $this->paginated);

        return view('livewire.admin.maintenance.occupation', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}