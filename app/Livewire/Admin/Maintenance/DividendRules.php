<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\FMS\DividendRules as FMSDividendRules;
use App\Models\Ref\RefRace;
use App\Services\General\PopupService;
use Livewire\Attributes\Rule;
use App\Traits\MaintenanceModalTrait;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class DividendRules extends Component
{
    use Actions, WithPagination, MaintenanceModalTrait;

    #[Rule('required|max:3|alpha')]
    public $code;

    #[Rule('required|string')]
    public $description;

    #[Rule('nullable|boolean')]
    public $status;

    public $openModal;
    public $modalTitle;
    public $modalDescription, $clientID, $minShare, $years;
    public $modalMethod;
    public $dividendRules;
    public $paginated;

    protected $popupService;

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->openModal = true;
        $this->modalTitle = 'Create Dividend Rules';
        $this->modalMethod = 'create';
    }

    public function openUpdateModal($id)
    {
        $this->dividendRules = FMSDividendRules::find($id);
        $this->clientID = $this->dividendRules->client_id;
        $this->minShare = $this->dividendRules->min_share;
        $this->years = $this->dividendRules->years;

        $this->openModal = true;
        $this->modalTitle = 'Update Dividend Rules';
        $this->modalMethod = "update({$id})";
    }

    public function create()
    {
        FMSDividendRules::create([
            'client_id'         => $this->clientID,
            'min_share'         => $this->minShare,
            'years'             => $this->years,
            'flag_dividend'     => 1,
        ]);

        $this->reset();
        $this->openModal = false;
    }

    public function update($id)
    {
        FMSDividendRules::where('id', $id)->update([
            'client_id'         => $this->clientID,
            'min_share'         => $this->minShare,
            'years'             => $this->years,
            'flag_dividend'     => 1,
        ]);

        $this->reset();
        $this->openModal = false;
    }

    public function delete($id)
    {
        $client_id = FMSDividendRules::whereId($id)->first();
        $this->popupService->confirm($this, 'ConfirmDelete', 'Delete', 'Are you sure to delete the Dividend Rule for Client ID ' . $client_id->client_id . '?', $id);
    }

    public function ConfirmDelete($id)
    {
        FMSDividendRules::whereId($id)->delete();
    }

    public function render()
    {
        $data = FMSDividendRules::paginate(10);
        return view('livewire.admin.maintenance.dividend-rules', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
