<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefRace;
use App\Services\Model\RaceService;
use App\Services\General\PopupService;
use Livewire\Attributes\Rule;
use App\Traits\MaintenanceModalTrait;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Race extends Component
{
    use Actions, WithPagination, MaintenanceModalTrait;

    #[Rule('required|numeric|min:1|max:99')]
    public $code;

    #[Rule('required|regex:/^[A-Za-z ]+(\([A-Za-z]+\))?$/')]
    public $description;

    #[Rule('numeric|min:1|max:9999')]
    public $priority;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $race;
    public $paginated;
    public $searchQuery;
    public $prio_id;

    protected $raceService;
    protected $popupService;

    public function __construct()
    {
        $this->raceService = new RaceService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Race", "Race");
        $this->reset(['description', 'code']); // Clear the values for description and code
        $this->resetValidation(); // Clear validation errors
    }

    public function openUpdateModal($id)
    {
        $this->prio_id = $id;
        $this->race = RefRace::find($id);
        $this->description = $this->race->description;
        $this->code = $this->race->code;
        $this->priority = $this->race->priority;
        $this->resetValidation(); // Clear validation errors
        $this->setupModal("update", "Update Race", "Race", "update({$this->prio_id})");
    }

    public function create()
    {
        
        $this->validate([
            'code' => 'required|numeric|min:1|max:99',
            'description' => 'required|regex:/^[A-Za-z ]+(\([A-Za-z]+\))?$/',
        ]);

        $paddedCode = str_pad(trim(strtoupper($this->code)), 2, '0', STR_PAD_LEFT);

        if (RaceService::isCodeExists($paddedCode)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $data = [
                'description' => trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
                'code' => $paddedCode,
            ];

            RaceService::createRace($data);
            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if (RaceService::canUpdateCode($id, $this->code)) {
            $data = [
                'description' => trim(preg_replace('/\s+/', ' ', strtoupper($this->description))),
                'priority' => $this->priority,
                'code' => str_pad(trim(strtoupper($this->code)), 2, '0', STR_PAD_LEFT),
            ];

            RaceService::updateRace($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id,$description)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you delete the'.$description.'?',$id);
    }

    public function ConfirmDelete($id)
    {
        RaceService::deleteRace($id);
    }

    public function render()
    {
        $data = $this->raceService->getRaceResult($this->searchQuery, $this->paginated);

        return view('livewire.admin.maintenance.race', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
