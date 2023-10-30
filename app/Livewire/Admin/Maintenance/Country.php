<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefCountry;
use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Services\Maintenance\CountryService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use WireUi\Traits\Actions;
use Livewire\WithPagination;

class Country extends Component
{
    use Actions, WithPagination , MaintenanceModalTrait;

    #[Rule('required|alpha')]
    public $code;

    #[Rule('required|string')]
    public $description;

    #[Rule('nullable|boolean')]
    public $status;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $country;
    public $clientId;
    public $paginated;

    protected $countryService;
    protected $popupService;

    public function __construct()
    {
        $this->countryService = new CountryService();
        $this->popupService = app(PopupService::class);
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Country", "Country");
    }

    public function openUpdateModal($id)
    {
        $this->country = RefCountry::find($id);
        $this->description = $this->country->description;
        $this->code = $this->country->code;
        $this->country->status == 1 ? $this->status = true : $this->status = false;
        $this->setupModal("update", "Update Country", "Country", "update({$id})");
    }

    public function create()
    {
        $this->validate();

        if ($this->countryService->isCodeExists($this->code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $this->countryService->createCountry($this->description, $this->code, $this->status);
            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if ($this->countryService->canUpdateCode($id, $this->code)) {
            $this->countryService->updateCountry($id, $this->description, $this->code, $this->status);
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
        $this->countryService->deleteCountry($id);
    }

    public function render()
    {
        $data = $this->countryService->getPaginatedCountry($this->paginated);

        return view('livewire.admin.maintenance.country',[
            'data' => $data,
        ])->extends('layouts.main');
    }
}
