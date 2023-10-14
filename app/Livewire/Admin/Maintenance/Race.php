<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefRace;
use App\Services\Maintenance\RaceService;
use App\Services\General\PopupService;
use Livewire\Attributes\Rule;
use App\Traits\MaintenanceModalTrait;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Race extends Component
{
    use Actions, WithPagination,MaintenanceModalTrait;

    #[Rule('required|max:3|alpha')]
    public $code;

    #[Rule('required|string')]
    public $description;

    #[Rule('nullable|boolean')]
    public $status;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $race;
    public $coopId;
    public $paginated;

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
    }

    public function openUpdateModal($id)
    {
        $this->race = RefRace::find($id);
        $this->description = $this->race->description;
        $this->code = $this->race->code;
        $this->race->status == 1 ? $this->status = true : $this->status = false;
        $this->setupModal("update", "Update Race", "Race", "update({$id})");
    }

    public function create()
    {
        $this->validate();

        if ($this->raceService->isCodeExists($this->code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $this->raceService->createRace($this->description, $this->code, $this->status);
            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if ($this->raceService->canUpdateCode($id, $this->code)) {
            $this->raceService->updateRace($id, $this->description, $this->code, $this->status);
            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you delete the information?',$id);
    }

    public function ConfirmDelete($id)
    {
        $this->raceService->deleteRace($id);
    }

    #[Layout('layouts.main')]
    public function render()
    {
        $data = $this->raceService->getPaginatedRace($this->paginated);

        return view('livewire.admin.maintenance.race', [
            'data' => $data,
        ]);
    }
}