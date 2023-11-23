<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefCountry;
use Livewire\Component;
use Livewire\Attributes\Rule;
use App\Services\Model\CountryService;
use App\Services\General\PopupService;
use App\Traits\MaintenanceModalTrait;
use WireUi\Traits\Actions;
use Livewire\WithPagination;

class Country extends Component
{
    use Actions, WithPagination, MaintenanceModalTrait;

    #[Rule('required|regex:/^[A-Za-z ]+(\([A-Za-z]+\))?$/')]
    public $description;

    #[Rule('required|min:2|max:2|alpha')]
    public $abbr;

    #[Rule('numeric|min:1|max:9999')]
    public $priority;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $country;
    public $paginated;
    public $searchQuery;
    public $prio_id;

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
        $this->reset(['description', 'abbr']); // Clear the values for description and abbr
        $this->resetValidation(); // Clear validation errors
    }

    public function openUpdateModal($id)
    {
        $this->prio_id = $id;
        $this->country = RefCountry::find($id);
        $this->description = $this->country->description;
        $this->abbr = $this->country->abbr;
        $this->priority = $this->country->priority;
        $this->setupModal("update", "Update Country", "Country", "update({$id})");
        $this->resetValidation(); // Clear validation errors
    }

    public function create()
    {
        
        $this->validate([
            'abbr' => 'required|min:2|max:2|alpha',
            'description' => 'required|regex:/^[A-Za-z ]+(\([A-Za-z]+\))?$/',
        ]);

        $paddedAbbr = str_pad(trim(strtoupper($this->abbr)), 2,'A', STR_PAD_LEFT);

        if (CountryService::isAbbrExists($paddedAbbr)) {
            $this->addError('abbr', 'The abbr has already been taken.');
        } else {
            $data = [
                'description' => trim(strtoupper(preg_replace('/\s+/', ' ', ($this->description)))),
                'abbr' => $paddedAbbr,
            ];

            CountryService::createCountry($data);
            $this->reset();
            $this->openModal = false;
        }
    }

    public function update($id)
    {
        $this->validate();

        if (CountryService::canUpdateAbbr($id, $this->abbr)) {
            $data = [
                'description' => trim(strtoupper(preg_replace('/\s+/', ' ', ($this->description)))),
                'abbr' => str_pad(trim(strtoupper($this->abbr)), 2, 'A', STR_PAD_LEFT),
                'priority' => $this->priority,
            ];

            CountryService::updateCountry($id, $data);
            $this->openModal = false;
        } else {
            $this->addError('abbr', 'The abbr has already been taken.');
        }
    }

    public function delete($id,$description)
    {
    $this->popupService->confirm($this, 'ConfirmDelete', 'Delete the information?', 'Are you sure you want to delete country ' . $description .'?', $id);
    }

    public function ConfirmDelete($id)
    {
        CountryService::deleteCountry($id);
    }

    public function render()
    {
        $data = $this->countryService->getCountryResult($this->searchQuery, $this->paginated);

        return view('livewire.admin.maintenance.country', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
